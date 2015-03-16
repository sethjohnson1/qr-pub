<?php
App::uses('AppController', 'Controller');

class AssetsController extends AppController {

	public $components = array('Paginator');

	public function admin_index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Paginator->paginate());
	}


	public function admin_view($id = null) {
		if (!$this->Asset->exists($id)) {
			throw new NotFoundException(__('Invalid asset'));
		}
		$options = array('conditions' => array('Asset.' . $this->Asset->primaryKey => $id));
		$this->set('asset', $this->Asset->find('first', $options));
	}


	public function admin_add($type=null,$id = null,$creator=null) {

		if ($this->request->is('post')) {
			if (isset($this->request->data['Asset']['vgaljson'])){
				$vgal=json_decode($this->request->data['Asset']['vgaljson'],true);
				//again, need to do this Delete after save somehow but this is Q&D
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				foreach (glob('img/uploads/'.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
				//loop through treasures to save and copy image and all treasure data
				foreach ($vgal['apivar']['Items'] as $key=>$value){
					if (isset($value['TreasuresUsergal']['comments'])) $comment=$value['TreasuresUsergal']['comments'];
					//else $comment=$value['Treasure']['synopsis'];
					//get all treasure data, loop all, ones without fields won't be saved
					foreach ($value['Treasure'] as $field=>$trdata){
						$asset[$field]=$trdata;
					}
					$this->Asset->create();
					$asset['name']='treasure';
					$asset['asset_text']=$comment;
					$asset['sortorder']=$value['TreasuresUsergal']['ord'];
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					//first get the thumbnail, which will use the id
					$uuid=String::uuid();
					$asset['id']=$uuid;
					$img=str_replace(' ','_',$value['Treasure']['img']); 
					copy('http://collections.centerofthewest.org/zoomify/1/'.$img.'/TileGroup0/0-0-0.jpg', 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg');
					
					//now get the large image, which will use the filename field
					$uuid=String::uuid();
					$asset['filename']=$uuid;
					//this is where the url encoding should be fixed for the small number of items with LAME file names
					copy('http://collectionimages.s3-website-us-west-1.amazonaws.com/1/'.urlencode($img), 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg');
					
					
					if ($this->Asset->save($asset)) {
						//$this->Session->setFlash(__('The asset has been saved.'));
						//return $this->redirect(array('action' => 'index'));
					}
					else {
						$this->Session->setFlash(__('Something went horribly wrong.'));
					}
				}
				//complete other saves
				$asset=array();
				$this->Asset->create();
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']='description';
				$asset['asset_text']=$vgal['apivar']['Usergal']['Usergal']['gloss'];
				//Q&D use filename for title and Author
				$asset['filename']=$vgal['apivar']['Usergal']['Usergal']['name'];
				$asset['filemime']=$vgal['apivar']['Usergal']['Usergal']['creator'];
				
				if ($this->Asset->save($asset)){
					$this->Session->setFlash(__('Saved the vgal'));
					return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
				}
				else $this->Session->setFlash(__('Something went horribly wrong.'));	
			}
			if (isset($this->request->data['Asset']['blogjson'])){
				$blog=json_decode($this->request->data['Asset']['blogjson'],true);
				$this->set('blog',$blog);
				if ($blog==null){
					$this->Session->setFlash(__('Error decoding JSON. Please contact admin'));
					return true;
				}
				else{
				//this is the basic idea of a blog save, still need to decide whether to strip HTML tags or leave them...
				//no, just style the divs
				
					$this->Asset->deleteAll(array('Asset.template_id'=>$id));
					foreach (glob('img/uploads/'.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
			
					$this->Asset->create();
					$asset['name']='author';
					$asset['asset_text']=$blog['author']['name'];
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					if ($this->Asset->save($asset)) $this->Session->setFlash(__('The asset has been saved.'));
					else $this->Session->setFlash(__('Author could not be saved'));
					
					$this->Asset->create();
					$asset['name']='title';
					$asset['asset_text']=$blog['title'];
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					if ($this->Asset->save($asset)) $this->Session->setFlash(__('The asset has been saved.'));
					else $this->Session->setFlash(__('Title could not be saved'));
					
					$this->Asset->create();
					$asset['name']='content';
					$asset['asset_text']=$blog['content'];
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					if ($this->Asset->save($asset)) $this->Session->setFlash(__('The asset has been saved.'));
					else $this->Session->setFlash(__('Content could not be saved'));
					
					//get all the images, for the iOS version we'll need to download them but for now just save to DB
					//this can be seen above in vgal
					$doc = new DOMDocument();
					@$doc->loadHTML($blog['content']);
					$tags = $doc->getElementsByTagName('img');
					foreach ($tags as $key=>$tag) {
						$this->Asset->create();
						$uuid=String::uuid();
						$asset['id']=$uuid;
						$asset['name']='image';
						$asset['sortorder']=$key;
						$asset['filename']=$tag->getAttribute('src');
						$asset['asset_text']=$tag->getAttribute('alt');
						$asset['template_id']=$this->request->data['Asset']['template_id'];
						if ($this->Asset->save($asset)){
							//now upload, keep in mind this is just the source img not the big (linked) version
							//currently these are not used
							copy($tag->getAttribute('src'), 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg');
							$this->Session->setFlash(__('The asset has been saved.'));
							return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
						}
						else $this->Session->setFlash(__('Image '.$key.' could not be saved'));
						
					}
				}
			}
			
			if ($type=='splash'){
				$asset=array();
				if ($this->request->data['Asset']['file']['error']!=0){
					$this->Session->setFlash(__('File upload returned an error'));
					break;
				}
				$uuid=String::uuid();
				$this->Asset->create();
				$asset=$this->request->data['Attribute'];
				$asset['id']=$uuid;
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']=$this->request->data['Asset']['file']['name'];
				$asset['filesize']=$this->request->data['Asset']['file']['size'];
				$asset['filemime']=$this->request->data['Asset']['file']['type'];
				//need to set some logic for delete and unlink
				
				//remove all previously linked files
				foreach (glob('img/uploads/'.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
				if (move_uploaded_file($this->request->data['Asset']['file']['tmp_name'], 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg')){
					$this->Asset->deleteAll(array('Asset.template_id'=>$id));
					if ($this->Asset->save($asset)) {
						$this->Session->setFlash(__('The asset has been saved!'));
						return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
					}
					else {
						$this->Session->setFlash(__('Something went horribly wrong.'));
					}
				}
				else $this->Session->setFlash(__('Error moving file to upload dir. Check permissions?'));
			}
			
			if ($type=='video'){
				
				//still would like better clean-up...
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				$uuid=String::uuid();
				$this->Asset->create();
				$asset['id']=$uuid;
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']=$this->request->data['Asset']['youtubeid'];
				//stash the text here as well - no need for another row at the moment
				$asset['asset_text']=$this->request->data['Attribute']['asset_text'];
				if ($this->Asset->save($asset)){ 
					$this->Session->setFlash(__('The asset has been saved.'));
					return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
				}
				else $this->Session->setFlash(__('Audio file data could not be saved'));

			}
			
			if ($type=='ag'){
				//did this one all on a single row using field names from OC
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				$asset=$this->request->data['Asset'];
				$uuid=String::uuid();
				$asset['id']=$uuid;
				$asset=$this->request->data['Asset'];
				$this->Asset->create();
				if ($this->Asset->save($asset)){
					$this->Session->setFlash(__('The asset has been saved.'));
					return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
				}
				else $this->Session->setFlash(__('Text could not be saved'));

			}
			
			if ($type=='tn'){
				
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				foreach (glob('img/uploads/'.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
				$xml = simplexml_load_string($this->request->data['Asset']['xml']);
				$json = json_encode($xml);
				$vgal = json_decode($json,TRUE);
				debug($vgal);
				//loop through treasures to save and copy image and all treasure data
				foreach ($vgal['treasure'] as $key=>$value){
					foreach ($value as $field=>$trdata){
						$asset[$field]=$trdata;
					}
					$this->Asset->create();
					$asset['name']='treasure';
					//I think this should always work, otherwise we need to add sortorder to XML file
					$asset['sortorder']=$key;
					$asset['template_id']=$this->request->data['Asset']['template_id'];
					//first get the thumbnail, which will use the id
					$uuid=String::uuid();
					$asset['id']=$uuid;
					copy('img/uploads/kiosk/'.$value['img'], 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg');

					if ($this->Asset->save($asset)) {
					}
					else {
						$this->Session->setFlash(__('Something went horribly wrong.'));
					}
				}
				
				//do the other save
				$asset=array();
				$this->Asset->create();
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']='description';
				$asset['asset_text']=$vgal['info']['description'];
				//use filename for title and filemime for Author
				$asset['filename']=$vgal['info']['title'];
				$asset['filemime']=$vgal['info']['creator'];
				
				if ($this->Asset->save($asset)){
					$this->Session->setFlash(__('Saved the vgal'));
					return $this->redirect(array('admin'=>true,'controller'=>'templates','action' => 'index',$creator));
				}
				else $this->Session->setFlash(__('Something went horribly wrong.'));			
			}
			
		}
		$template = $this->Asset->Template->find('first',array('conditions'=>array('Template.id'=>$id)));
		$this->set(compact('type','template','id','creator'));
	}
	


	public function admin_ajaxblog() {
		//technically you'd want this in production but it doesn't really matter here
		//if ($this->request->is('ajax')) {
		$ch = curl_init();
		$timeout = 5;
 		curl_setopt($ch,CURLOPT_URL,'http://centerofthewest.org/wp-json/posts/'.$this->request->data['Asset']['blogid']);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		
        $this->set('content', htmlentities($data)); 

        $this->render('ajax_response', 'ajax');
		//}
    }
	
	public function admin_ajaxvgal() {
		//if ($this->request->is('ajax')) {
		
		$ch = curl_init();
		$timeout = 5;
 		curl_setopt($ch,CURLOPT_URL,'http://collections.centerofthewest.org/usergals/view/'.$this->request->data['Asset']['vgalid'].'.json');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		//just send straight data and we'll decode when the form is submitted
         $this->set('content', $data); 

        $this->render('ajax_response', 'ajax');
		//}
    }

/*
	public function edit($id = null) {
		if (!$this->Asset->exists($id)) {
			throw new NotFoundException(__('Invalid asset'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Asset->save($this->request->data)) {
				$this->Session->setFlash(__('The asset has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Asset.' . $this->Asset->primaryKey => $id));
			$this->request->data = $this->Asset->find('first', $options);
		}
		$templates = $this->Asset->Template->find('list');
		$this->set(compact('templates'));
	}


	public function delete($id = null) {
		$this->Asset->id = $id;
		if (!$this->Asset->exists()) {
			throw new NotFoundException(__('Invalid asset'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Asset->delete()) {
			$this->Session->setFlash(__('The asset has been deleted.'));
		} else {
			$this->Session->setFlash(__('The asset could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	*/
}
