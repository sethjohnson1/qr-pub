<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $components = array('Paginator','ExtAuth.ExtAuth','Auth','Session');


	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}


	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
	
	//just here for testing
	public function dummyAuth($id){
		$fuser=$this->User->findById(5);
		$user['id']=$id;
		$user['username']='sethtest'.$id;
		$user['upvotes']=null;
		$user['downvotes']=null;
		$user['flagged']=null;
		
		//$this->Auth->login($fuser['User']);
		$this->Auth->login($user);
		//$this->redirect($this->referer());
	}
	
	//now for the ExtAuth stuff
	
	public function auth_login($provider) {
		$result = $this->ExtAuth->login($provider);
		if ($result['success']) {

			$this->redirect($result['redirectURL']);

		} else {
			$this->Session->setFlash($result['message']);
			$this->redirect($this->Auth->loginAction);
		}
	}
	
	public function auth_callback($provider) {
		$result = $this->ExtAuth->loginCallback($provider);
		if ($result['success']) {

			$this->__successfulExtAuth($result['profile'], $result['accessToken']);

		} else {
			$this->Session->setFlash($result['message']);
			$this->redirect($this->Auth->loginAction);
		}
	}
	
	
	private function __successfulExtAuth($incomingProfile, $accessToken) {
		$user=$this->User->findByOid($incomingProfile['oid']);
		if ($user) {
			$this->__doAuthLogin($user);
		}
		else {
		//make a new account, not much needs to be done with the data the fields were named for the API calls
			$incomingProfile['ip'] = $_SERVER["REMOTE_ADDR"]; 
			
			if ($this->User->save($incomingProfile)){
				$user['User']=$incomingProfile;
				$this->__doAuthLogin($user);
			}
			else {
				$this->Session->setFlash('Something has gone wrong. Please try again or contact the system admin.');
				debug($this->User->invalidFields());
			}
		}
		//debug($incomingProfile);
	}
	private function __doAuthLogin($user) {
		if ($this->Auth->login($user['User'])) {
			$user['User']['last_login'] = date('Y-m-d H:i:s');
			if ($this->User->save($user['User'])){
				$this->Session->setFlash('Thanks '.$this->Auth->user('given_name').'! You are logged in.');
				
				if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
				else $this->redirect('/');
			}
			else {
				$this->Session->setFlash('Something has gone wrong. Please try again or contact the system admin.');
				debug($this->User->invalidFields());
			}
		}
	}
	
	public function logout() {
		//$user = $this->Auth->user();
		$location=$this->Session->read('location');
		$this->Session->destroy();
		$this->Session->setFlash('Ok bye-bye');
		//$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged out'), $user[$this->{$this->modelClass}->displayField]));
		if ($location) $this->redirect($location);
		else $this->redirect('/');
	}

}
