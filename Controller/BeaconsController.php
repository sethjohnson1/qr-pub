<?php
App::uses('AppController', 'Controller');
/**
 * Beacons Controller
 *
 * @property Beacon $Beacon
 * @property PaginatorComponent $Paginator
 */
class BeaconsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Beacon->recursive = 0;
		$this->set('beacons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Beacon->exists($id)) {
			throw new NotFoundException(__('Invalid beacon'));
		}
		$options = array('conditions' => array('Beacon.' . $this->Beacon->primaryKey => $id));
		$this->set('beacon', $this->Beacon->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
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

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
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
