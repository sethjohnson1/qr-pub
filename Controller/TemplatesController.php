<?php
App::uses('AppController', 'Controller');
/**
 * Templates Controller
 *
 * @property Template $Template
 * @property PaginatorComponent $Paginator
 */
class TemplatesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$templates=array('splash'=>'Big image','video'=>'AV page','blog'=>'Web article','vgal'=>'Virtual Gallery');
		$locations=array('BBM'=>'BBM','CFM'=>'CFM','DMNH'=>'DMNH','Garden'=>'Garden','HMRL'=>'HMRL','PIM'=>'PIM','WG'=>'WG');
		$this->set(compact('templates','locations'));
		//$this->set('templates',$templates);
	}
	public $components = array('Paginator','Comment');


	public function index() {
		$this->Template->recursive = 0;
		$this->set('templates', $this->Paginator->paginate());
	}


	public function view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$template=$this->Template->find('first', $options);
		$this->set('id',$id);
		$user=$this->Auth->user();
		if (isset($user)) $this->set('user',$user);
		
		//user Comments component to load up view variables
		$comments=$this->Comment->getComments($id);
		$usercomments=$this->Comment->userComment($id,$user['id']);
		
		//debug($usercomments);
		$this->set(compact('comments','template','usercomments'));
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
