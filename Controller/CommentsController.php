<?php
App::uses('AppController', 'Controller');

class CommentsController extends AppController {

	public $components = array('Paginator');


	public function admin_index($creator=null) {
		$this->Comment->recursive = 0;
		$conditions='';
		if ($creator != Configure::read('globalSuperUser')) $conditions=array('Template.creator'=>$creator);
		$this->paginate=array('limit'=>100,'conditions'=>$conditions);
		$comments=$this->Paginator->paginate();
		$this->set(compact('comments', 'creator'));
		
		
		//this will remove duplicates
		$dups=$this->Comment->find('all', array('fields' => array('Comment.thoughts', 'count(*) as Total'),'group' => array('Comment.thoughts HAVING COUNT(*) > 1')));
		foreach ($dups as $key=>$val){
			$numtimes=$val[0]['Total']-1;
			$this->Comment->query('DELETE FROM comments WHERE thoughts="'.$val['Comment']['thoughts'].'" LIMIT '.$numtimes);
		}
		
	}

	public function admin_edit($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect($this->referer());
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		//$users = $this->Comment->User->find('list');
		//$this->set(compact('users'));
	}

}
