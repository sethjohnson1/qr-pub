<?php
App::uses('AppController', 'Controller');

class BeaconsController extends AppController {


	public $components = array('Paginator');


	public function admin_index() {
		$this->Beacon->recursive = 0;
		$this->set('beacons', $this->Paginator->paginate());
	}


	public function admin_view($id = null) {
		if (!$this->Beacon->exists($id)) {
			throw new NotFoundException(__('Invalid beacon'));
		}
		$options = array('conditions' => array('Beacon.' . $this->Beacon->primaryKey => $id));
		$this->set('beacon', $this->Beacon->find('first', $options));
	}


	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Beacon->create();
			if ($this->Beacon->save($this->request->data)) {
				$this->Session->setFlash(__('The beacon has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The beacon could not be saved. Please, try again.'));
			}
		}
		$templates = $this->Beacon->Template->find('list');
		$this->set(compact('templates'));
	}


	public function admin_edit($id = null) {
		if (!$this->Beacon->exists($id)) {
			throw new NotFoundException(__('Invalid beacon'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Beacon->save($this->request->data)) {
				$this->Session->setFlash(__('The beacon has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The beacon could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Beacon.' . $this->Beacon->primaryKey => $id));
			$this->request->data = $this->Beacon->find('first', $options);
		}
		$templates = $this->Beacon->Template->find('list');
		$this->set(compact('templates'));
	}


	public function admin_delete($id = null) {
		$this->Beacon->id = $id;
		if (!$this->Beacon->exists()) {
			throw new NotFoundException(__('Invalid beacon'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Beacon->delete()) {
			$this->Session->setFlash(__('The beacon has been deleted.'));
		} else {
			$this->Session->setFlash(__('The beacon could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
