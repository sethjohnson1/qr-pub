<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$templates=array('splash'=>'Big image','video'=>'AV page','blog'=>'Web article','vgal'=>'Virtual Gallery');
		$locations=array('BBM'=>'BBM','CFM'=>'CFM','DMNH'=>'DMNH','Garden'=>'Garden','HMRL'=>'HMRL','PIM'=>'PIM','WG'=>'WG');
		$this->set(compact('templates','locations'));
	}
	
	public $components = array('Paginator','Comment');


	public function index() {
		$this->Template->recursive = 0;
		$this->set('templates', $this->Paginator->paginate());
				if ($this->request->is('post')) {
			if (isset($this->request->data['Code']['3digitcode'])){
				$template_redir=$this->Template->find('first',array(
					'conditions'=>array('Template.code'=>$this->request->data['Code']['3digitcode']),
					'recursive'=>-1
					
				));
				
				if (!isset($template_redir['Template']['id'])) {
					throw new NotFoundException(__('Code came back 404'));
				}
				
				else {
					return $this->redirect(array('cont roller'=>'templates','action'=>'view',
					$this->request->data['Code']['3digitcode']));
				}
			}
			//debug($template);
			//return false;
			//return $this->redirect($this->request->data['Code']['3digitcode'].'/');
		}
	}


	public function view($id = null) {
		if ($this->request->is('post')) {
		//maybe this should be a component . . .
			if (isset($this->request->data['Code']['3digitcode'])){
				$template_redir=$this->Template->find('first',array(
					'conditions'=>array('Template.code'=>$this->request->data['Code']['3digitcode']),
					'recursive'=>-1
					
				));
				
				if (!isset($template_redir['Template']['id'])) {
					throw new NotFoundException(__('Code came back 404'));
				}
				
				else {
					return $this->redirect(array('controller'=>'templates','action'=>'view',
					$template_redir['Template']['id']));
				}
			}
		}	
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$template=$this->Template->find('first', $options);
		//$this->set('id',$id);
		$user=$this->Auth->user();
		if (isset($user)) $this->set('user',$user);
		//user Comments component to load up view variables
		$comments=$this->Comment->getComments($id,$user['id']);
		$usercomment=$this->Comment->userComment($id,$user['id']);
		//count all the templates, this might need to be a Component some day
		//also, we're counting *ALL* templates, not taking into account child templates, for now that's
		//how we'll do it, the other conditional logic is simple enough
		$totals=array();
		$totals['totals']['BBM']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'BBM')));
		$totals['totals']['CFM']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'CFM')));
		$totals['totals']['DMNH']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'DMNH')));
		$totals['totals']['PIM']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'PIM')));
		$totals['totals']['WG']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'WG')));
		$totals['totals']['HMRL']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'HMRL')));
		$totals['totals']['Garden']=$this->Template->find('count',array('conditions'=>array('Template.location'=>'Garden')));
		if (isset($user) && isset($template['Template']['id'])) {
			$this->loadModel('Scorecard');
			//combine user_id and template to make a unique identifier (but also cannot be counted over and over)
			$scoreid=$user['id'].'_'.$id;
			$scoredata['id']=$scoreid;
			$scoredata['location']=$template['Template']['location'];
			//$scoredata['user_id']=$user['id'];
			if ($this->Scorecard->save($scoredata)){
				//saved logged in user scoredata, now tally
				$totals['counts']['BBM']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'BBM')));
				$totals['counts']['CFM']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'CFM')));
				$totals['counts']['DMNH']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'DMNH')));
				$totals['counts']['PIM']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'PIM')));
				$totals['counts']['WG']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'WG')));
				$totals['counts']['HMRL']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'HMRL')));
				$totals['counts']['Garden']=$this->Scorecard->find('count',array('conditions'=>array("Scorecard.id LIKE '".$user['id']."_%'",'Scorecard.location'=>'Garden')));
			
			}
		}
		else {
		//use Session variables if no logged on user
			//first write the session, using the ID of the template to prevent double-counting
			$this->Session->write(
			'counts.'.$template['Template']['location'].'.'.$template['Template']['id'], true);
			$totals['counts']=$this->Session->read('counts');
			$totals['counts']['BBM']=count($this->Session->read('counts.BBM'));
			$totals['counts']['CFM']=count($this->Session->read('counts.CFM'));
			$totals['counts']['DMNH']=count($this->Session->read('counts.DMNH'));
			$totals['counts']['PIM']=count($this->Session->read('counts.PIM'));
			$totals['counts']['WG']=count($this->Session->read('counts.WG'));
			$totals['counts']['HMRL']=count($this->Session->read('counts.HMRL'));
			$totals['counts']['Garden']=count($this->Session->read('counts.Garden'));
	
		}
		
		$this->set(compact('comments','template','usercomment','template_redir','totals','id'));
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
		$this->render('add');
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
