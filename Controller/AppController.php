<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = array('Users.RememberMe','Scorecard','DebugKit.Toolbar','Session','Cookie','Auth'=>array(),
	'UrlShortener'
	//'Security'=>array('csrfUseOnce' => false,'validatePost' => false,'allowedControllers'=>array('templates','commentsusers','users'))
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Security->blackHoleCallback = 'blackhole';
		$user=$this->Auth->user();
		//will need to be tightened later
		$this->Auth->allow();
		$this -> layout='mobile'; //added by LJ to use the jqm layout
		//users plugin blackhole fix, started somewhere in CakePHP 2.5.3
		if (isset($this->Security) && ( $this->action == 'login' || $this->action == 'reset_password' || $this->action == 'resend_verification')) {
			$this->Security->validatePost = false;
		}
			
			//for getting the user back to whence they came after logging in, using a whitelist for now
			if ($this->request->params['action']=='index'||$this->request->params['action']=='view'){
				//this is dirty, but for some reason it writes /qr/qr whenever redirecting, and I don't know how it will behave on its own domain (probably fine), 
				//so for now this little bit of dickery
				$current=explode('/',$this->here);
				unset($current[0]);
				unset($current[1]);
				$current=implode('/',$current);
				$current='/'.$current;
				$this->Session->write('location',$current);
			}
		$this->set('totals',$this->Scorecard->scoreTotals(null,$user['id']));
		

	}
	

	public function blackhole($type) {
		//debug($type);
		//this logic needs to be changed, this is just for testing
		$this->Session->setFlash('blackhole '.$type,'flash_custom');
	}
	
	
	

}
