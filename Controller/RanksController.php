<?php
App::uses('AppController', 'Controller');

class RanksController extends AppController {

	public $components = array('Paginator', 'Session','Search.Prg');

	public function admin_index() {
		$this->Rank->recursive = 0;
		$this->Prg->commonProcess();
		$this->paginate = array('conditions' => $this->Rank->parseCriteria($this->Prg->parsedParams()));
		$ranks=$this->Paginator->paginate();
		$this->set(compact('ranks'));
	}


	public function admin_view($id = null) {
		if (!$this->Rank->exists($id)) {
			throw new NotFoundException(__('Invalid rank'));
		}
		$options = array('conditions' => array('Rank.' . $this->Rank->primaryKey => $id));
		$this->set('rank', $this->Rank->find('first', $options));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Rank->create();
			if ($this->Rank->save($this->request->data)) {
				$this->Session->setFlash(__('The rank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rank could not be saved. Please, try again.'));
			}
		}
		$this->set('edit',false);
	}


	public function admin_edit($id = null) {
		if (!$this->Rank->exists($id)) {
			throw new NotFoundException(__('Invalid rank'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rank->save($this->request->data)) {
				$this->Session->setFlash(__('The rank has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rank could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rank.' . $this->Rank->primaryKey => $id));
			$this->request->data = $this->Rank->find('first', $options);
		}
		$this->set('edit',true);
		$this->render('admin_add','default');
	}

	public function admin_delete($id = null) {
		$this->Rank->id = $id;
		if (!$this->Rank->exists()) {
			throw new NotFoundException(__('Invalid rank'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Rank->delete()) {
			$this->Session->setFlash(__('The rank has been deleted.'));
		} else {
			$this->Session->setFlash(__('The rank could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
