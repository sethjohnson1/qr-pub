<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class TemplatesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$templates=array('splash'=>'Big image','video'=>'AV page','blog'=>'Web article','vgal'=>'Virtual Gallery');
		$locations=array('BBM'=>'Buffalo Bill Museum','CFM'=>'Cody Firearms Museum','DMNH'=>'Draper Museum of Natural History','Garden'=>'Garden Areas',
		'HMRL'=>'McCracken Research Library','PIM'=>'Plains Indian Museum','WG'=>'Whitney Gallery of Western Art');
		$this->set(compact('templates','locations'));
		$this->set('meta_description', 'Digital and Virtual tour of the Buffalo Bill Center of the West.');
	}
	
	public $components = array('Paginator','Comment','Scorecard');
	
	public function browse($location = null) {
		if(isset($location)){
			$stops=$this->Template->find('all',array('conditions'=>array('Template.location'=>$location),'recursive'=>-1));
		}
		$this->set(compact('locations','location','stops'));
		$this->set('title_for_layout', 'Browse');
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
		}
		$this->set('title_for_layout','Offer Feedback');
	}

	public function code_button() {
		if ($this->request->is('post')) {
			if (isset($this->request->data['Code']['3digitcode'])){
				$template_redir=$this->Template->find('first',array(
					'conditions'=>array('Template.code'=>$this->request->data['Code']['3digitcode']),
					'recursive'=>-1
				));
				
				if (!isset($template_redir['Template']['id'])) {
					$this->Session->setFlash('Sorry, that code did not work','flash_custom');
					return $this->redirect($this->referer());
				}
				
				else {
					return $this->redirect(array('controller'=>'templates','action'=>'view',
					$template_redir['Template']['id']));
				}
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
		else $user['id']=null;
		//user Comments component to load up view variables
		$comments=$this->Comment->getComments($id,$user['id']);
		$usercomment=$this->Comment->userComment($id,$user['id']);
		//override AppController value
		$totals=$this->Scorecard->scoreTotals($template,$user['id']);
		$this->set(compact('user','comments','template','usercomment','template_redir','totals','id'));
		
		//an example of how to shorten URL, doesn't work until live on server
		$this->set('shorturlexample',$this->UrlShortener->get_bitly_short_url($this->here,'social','facebook'));									
		$this->set('title_for_layout', $template['Template']['meta_title']);
		//the description does not need to be set here, but in the individual templates (see vgal)
		
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

	//I don't think this is used any longer
	public function commentbutton() {
		//if ($this->request->is('ajax')){
			//$this->set('content', $thread[0]->id); 
			$this->set('content', $data);
			$this->render('ajax_response', 'ajax');
		//}
    }


	public function add($id = null) {
		if ($this->request->is('post')) {
			$this->Template->create();
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','action' => 'add',$this->request->data['Template']['name'],$this->Template->getLastInsertID()));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
			}
			
		}
		$this->render('add','default');
	}


	public function edit($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','action' => 'add',$this->request->data['Template']['name'],$id));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again. Double-check nextid'));
			}
		} else {
			$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
			$this->request->data = $this->Template->find('first', $options);
		}
		$this->set('edit',true);
		
		//add 'ajax' here to help with debugging
		$this->render('add','default');
	}
	
	public function index() {
		$this->Template->recursive = 0;
		$templates=$this->Paginator->paginate();
		$user=$this->Auth->user();
		$totals=$this->Scorecard->scoreTotals(null,$user['id']);
		$this->set(compact('templates','totals'));
		$this->render('index','default');
	}


	public function delete($id = null) {
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
