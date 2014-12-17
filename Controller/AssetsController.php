<?php
App::uses('AppController', 'Controller');
App::uses('htmlpurifier/HTMLPurifier.standalone', 'Vendor');

class AssetsController extends AppController {

	public $components = array('Paginator','Clean');

	public function index() {
		$this->Asset->recursive = 0;
		$this->set('assets', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Asset->exists($id)) {
			throw new NotFoundException(__('Invalid asset'));
		}
		$options = array('conditions' => array('Asset.' . $this->Asset->primaryKey => $id));
		$this->set('asset', $this->Asset->find('first', $options));
	}


	public function add($type=null,$id = null) {

		if ($this->request->is('post')) {
			if (isset($this->request->data['Asset']['vgaljson'])){
				$vgal=json_decode($this->request->data['Asset']['vgaljson'],true);
				//again, need to do this Delete after save somehow but this is Q&D
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				foreach (glob('img/uploads/'.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
				//loop through treasures to save and copy image
				foreach ($vgal['apivar']['Items'] as $key=>$value){
					if (isset($value['TreasuresUsergal']['comments'])) $comment=$value['TreasuresUsergal']['comments'];
					else $comment=$value['Treasure']['synopsis'];
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
					copy('http://collectionimages.s3-website-us-west-1.amazonaws.com/1/'.urlencode($value['Treasure']['img']), 'img/uploads/'.$this->request->data['Asset']['template_id'].'_'.$uuid.'.jpg');
					
					
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
				
				if ($this->Asset->save($asset)) $this->Session->setFlash(__('Saved the vgal'));
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
					$this->Asset->deleteAll(array('Asset.template_id'=>$id));
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
						//debug( $tag->getAttribute('src'));
						$this->Asset->create();
						$asset['name']='image';
						$asset['sortorder']=$key;
						$asset['asset_text']=$tag->getAttribute('src');
						$asset['template_id']=$this->request->data['Asset']['template_id'];
						if ($this->Asset->save($asset)) $this->Session->setFlash(__('The asset has been saved.'));
						else $this->Session->setFlash(__('Image '.$key.' could not be saved'));
					}
						
					//debug($img);
				//	return true;
				}
			}
			
			if ($type=='splash'){	
				$asset=array();
				if ($this->request->data['Asset']['file']['error']!=0){
					$this->Session->setFlash(__('File upload returned an error'));
					break;
				}
				//debug($this->request->data['Asset']['file']);
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
				foreach (glob(APP.'uploads'.DS.$this->request->data['Asset']['template_id'].'_*') as $filename) unlink($filename);
				if (move_uploaded_file($this->request->data['Asset']['file']['tmp_name'], APP.'uploads'.DS.$this->request->data['Asset']['template_id'].'_'.$uuid)){
					$this->Asset->deleteAll(array('Asset.template_id'=>$id));
					if ($this->Asset->save($asset)) {
						$this->Session->setFlash(__('The asset has been saved!'));
						//return $this->redirect(array('action' => 'index'));
					}
					else {
						$this->Session->setFlash(__('Something went horribly wrong.'));
					}
				}
				else $this->Session->setFlash(__('Error moving file to upload dir. Check permissions?'));
			}
			
			if ($type=='video'){
				debug($this->request->data);
				//still would like better clean-up...
				$this->Asset->deleteAll(array('Asset.template_id'=>$id));
				$uuid=String::uuid();
				$this->Asset->create();
				$asset['id']=$uuid;
				$asset['template_id']=$this->request->data['Asset']['template_id'];
				$asset['name']=$this->request->data['Asset']['youtubeid'];
				//stash the text here as well - no need for another row at the moment
				$asset['asset_text']=$this->request->data['Attribute']['asset_text'];
				if ($this->Asset->save($asset)) $this->Session->setFlash(__('The asset has been saved.'));
				else $this->Session->setFlash(__('Audio file data could not be saved'));

			}
			
		}
		$template = $this->Asset->Template->find('first',array('conditions'=>array('Template.id'=>$id)));
		$this->set(compact('type','template','id'));
	}
	


	public function ajaxblog() {

		//disabled for testing
		//if ($this->request->is('ajax')) {
		
		$ch = curl_init();
		$timeout = 5;
 		curl_setopt($ch,CURLOPT_URL,'http://centerofthewest.org/wp-json/posts/'.$this->request->data['Asset']['blogid']);
 		//curl_setopt($ch,CURLOPT_URL,'http://centerofthewest.org/wp-json/posts/23159');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		
        $this->set('content', htmlentities($data)); 

        $this->render('ajax_response', 'ajax');
		//}
    }
	
	public function ajaxvgal() {
		//disabled for testing
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
