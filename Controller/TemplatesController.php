<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class TemplatesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$templates=array(
		'splash'=>'Big image','video'=>'AV page','blog'=>'Web article','vgal'=>'Virtual Gallery','ag'=>'AcoustiGuide');
		$locations=array('BBM'=>'Buffalo Bill Museum','CFM'=>'Cody Firearms Museum','DMNH'=>'Draper Natural History Museum','Garden'=>'Garden Areas',
		'HMRL'=>'McCracken Research Library','PIM'=>'Plains Indian Museum','WG'=>'Whitney Western Art Museum','NW'=>'Nowhere');
		$this->set(compact('templates','locations'));
		$this->set('meta_description', 'Digital and Virtual tour of the Buffalo Bill Center of the West.');
	}
	
	public $components = array('Paginator','Comment','Scorecard','Search.Prg');
	
	public function browse() {
		$stops=array();
		//may want to add another condition such as "prev id is null" if there are lots of chained templates
		//for now just get all of them!
		foreach ($this->viewVars['locations'] as $key=>$location){
		if ($key=='NW') continue;
			$stops[$key]=$this->Template->find('all',array(
			'conditions'=>array('Template.active'=>1,'Template.location'=>$key,'Template.previd is null'),
			'recursive'=>-1));
		}
		$this->set(compact('stops'));
		$this->set('title_for_layout', 'Browse');
		
		//$this->render('browse','default');
	}
	
	
	public function about() {
		//basically a static page but we might need some variables.. who knows.
		$this->set('title_for_layout','About');
	}
	
	public function feedback() {
		if ($this->request->is('post')) {
			//send an e-mail reads addresses from private config file
			$Email = new CakeEmail();
			$Email->from(Configure::read('globalFromEmail'))
				->to(Configure::read('globalAdminEmail'))
				->subject('iScout Feedback')
				->send(
				"From: ".$this->request->data['Feedback']['email']."\n\n\n".
				$this->request->data['Feedback']['message']
				);
			//$this->render(false);
			$this->Session->setFlash('Your message was sent! Thank you.','flash_custom');
			
			if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
			else $this->redirect('/');
		}
		$this->set('title_for_layout','Offer Feedback');
	}

	//$id is the template id
	public function code_button($id=null,$code=null) {
		//got here from ajax
		if (!empty($code)){
			if ($id !=0){
				$this->Session->setFlash('Viewing Code '.$code,'flash_custom');
				return $this->redirect(array('controller'=>'templates','action'=>'view',$id));
			}
			else {
				$this->Session->setFlash('Sorry, code '.$code.' did not work','flash_custom');
				return $this->redirect($this->referer());
			}
		}
		if ($this->request->is('post') || $this->request->is('ajax')) {
			if (isset($this->request->data['Code']['3digitcode'])){
			//debug($this->request->data);
				$template_redir=$this->Template->find('first',array(
					'conditions'=>array('Template.code'=>$this->request->data['Code']['3digitcode']),
					'recursive'=>-1
				));
				
				if (!isset($template_redir['Template']['id'])) {
					$template_redir['Template']['id']=0;
				}

				//just build URL here, as it redirects back here anyway
				$this->set('content',$template_redir['Template']['id'].'/'.$this->request->data['Code']['3digitcode']);
				$this->render('ajax_response', 'ajax');	

			}
		}
	}

	public function view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$template=$this->Template->find('first', $options);
		$user=$this->Auth->user();
		if (isset($user)) $this->set('user',$user);
		else {
			$user['id']=null;
			$user['provider']=null;
		}
		//user Comments component to load up view variables
		$comments=$this->Comment->getComments($id,$user['id']);
		$usercomment=$this->Comment->userComment($id,$user['id']);
		//override AppController value
		$totals=$this->Scorecard->scoreTotals($template,$user['id']);
		$this->set(compact('user','comments','template','usercomment','template_redir','totals','id'));
		
		//URL shortener - will return BAD_REQUEST unless on live domain
		$this->set('shorturl',$this->UrlShortener->get_bitly_short_url($this->here,'social',$user['provider']));									
		$this->set('title_for_layout', $template['Template']['meta_title']);
		//the description does not need to be set here, but in the individual templates (see vgal)
		//$this->render('view','default');
	}
	public function clear_card() {
		$user=$this->Auth->user();
		if (isset($user)) {
			$this->loadModel('Scorecard');
			$this->Scorecard->deleteAll(array("Scorecard.id LIKE '".$user['id']."_%'"), false);
		}
		$this->Session->delete('counts');
		if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
		else $this->redirect('/');
	}
	
	/*
	sends an e-mail via userPopup, at this point it is very basic, I think I'll wait until
	someone else wants to help with this, as I doubt it will get used much
	*/
	public function email($id=null,$url=null){
		//currently these look so much like SPAM I can't get Google not to filter them.
		//possibly because they are coming from an IP though, it might be fine in production
		$Email = new CakeEmail();
		$Email->from(Configure::read('globalFromEmail'))
		//assuming this is set, it should be or something weird is happening
			->to($this->Auth->user('email'))
			->subject('iScout Virtual Tour')
			->send(
				"
I thought you might enjoy this Virtual Exhibit from the Buffalo Bill Center of the West. Here is a 
shortened link to it:\n\n".urldecode($url)."\n\nYou can complete the entire tour online at ".
Configure::read('globalSiteURL')." although it's much more awesome in person."
			);
		//$this->render(false);
		$this->Session->setFlash('Your message was sent! Thank you.','flash_custom');
		$this->redirect($this->referer());
	}

	//I don't think this is used any longer
	public function commentbutton() {
		//if ($this->request->is('ajax')){
			//$this->set('content', $thread[0]->id); 
			$this->set('content', $data);
			$this->render('ajax_response', 'ajax');
		//}
    }

	public function admin_view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options['conditions'] = array('Template.' . $this->Template->primaryKey => $id);
		//$options['recursive']= 0;
		$this->set('template', $this->Template->find('first', $options));
	}
	
	public function admin_add($id = null) {
		if ($this->request->is('post')) {
			$this->Template->create();
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','admin'=>true,'action' => 'add',$this->request->data['Template']['name'],$this->Template->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
			}
			
		}
		//$this->render('admin_add','default');
	}


	public function admin_edit($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','admin'=>true,'action' => 'add',$this->request->data['Template']['name'],$id));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again. Double-check nextid'));
			}
		} else {
			$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
			$this->request->data = $this->Template->find('first', $options);
		}
		$this->set('edit',true);
		
		//add 'ajax' here to help with debugging
		$this->render('admin_add','default');
	}
	
	public function admin_index($creator=null) {
		$this->Prg->commonProcess();
		$this->Template->recursive = 0;
		//superuser sees all!
		if ($creator==Configure::read('globalSuperUser')){
			$this->paginate = array('conditions' => $this->Template->parseCriteria($this->Prg->parsedParams()));
		}
		else {
			$this->paginate = array('conditions' => array($this->Template->parseCriteria($this->Prg->parsedParams()),
			'AND'=>array('Template.creator'=>$creator)));
		}
		//no error handling needed, the paginator will just be empty
		$templates=$this->Paginator->paginate();
		$user=$this->Auth->user();
		$totals=$this->Scorecard->scoreTotals(null,$user['id']);
		$this->set(compact('templates','totals'));
		//$this->render('admin_index','default');
	}


	public function admin_delete($id = null) {
		$this->Template->id = $id;
		if (!$this->Template->exists()) {
			throw new NotFoundException(__('Invalid template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Template->delete()) {
			$this->Session->setFlash(__('The template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The template could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
