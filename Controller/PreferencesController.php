<?php
App::uses('AppController', 'Controller');

class PreferencesController extends AppController {


	public $components = array('Paginator');

/*
	public function index() {
		$this->Preference->recursive = 0;
		$this->set('preferences', $this->Paginator->paginate());
	}


	public function view($id = null) {
		if (!$this->Preference->exists($id)) {
			throw new NotFoundException(__('Invalid preference'));
		}
		$options = array('conditions' => array('Preference.' . $this->Preference->primaryKey => $id));
		$this->set('preference', $this->Preference->find('first', $options));
	}


	public function add() {
		if ($this->request->is('post')) {
			$this->Preference->create();
			if ($this->Preference->save($this->request->data)) {
				$this->Session->setFlash(__('The preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The preference could not be saved. Please, try again.'));
			}
		}
	}


	public function edit($id = null) {
		if (!$this->Preference->exists($id)) {
			throw new NotFoundException(__('Invalid preference'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Preference->save($this->request->data)) {
				$this->Session->setFlash(__('The preference has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The preference could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Preference.' . $this->Preference->primaryKey => $id));
			$this->request->data = $this->Preference->find('first', $options);
		}
	}


	public function delete($id = null) {
		$this->Preference->id = $id;
		if (!$this->Preference->exists()) {
			throw new NotFoundException(__('Invalid preference'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Preference->delete()) {
			$this->Session->setFlash(__('The preference has been deleted.'));
		} else {
			$this->Session->setFlash(__('The preference could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
*/
	}
