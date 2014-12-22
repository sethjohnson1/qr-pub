<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array('DebugKit.Toolbar','Session','Cookie','Auth'=>array()
	
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		//only enable below for testing
		$this->Auth->allow();
		$this -> layout='mobile'; //added by LJ to use the jqm layout

		//users plugin blackhole fix, started somewhere in CakePHP 2.5.3
		if (isset($this->Security) && ( $this->action == 'login' || $this->action == 'reset_password')) {
			$this->Security->validatePost = false;
		}
			//debug($this->Auth->user());
 	
	}
	

}
