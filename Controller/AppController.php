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
		
		//simple prefix check
		if( !isset($this->params['prefix'])){
			$this->Auth->allow();
			$this -> layout='mobile';
		}
		else if (Configure::read('enableAdminFunctions')==1) $this->Auth->allow();
		else throw new NotFoundException(__('Admin routing is disabled'));
		
		
		//users plugin blackhole fix, started somewhere in CakePHP 2.5.3
		if (isset($this->Security) && ( $this->action == 'login' || $this->action == 'reset_password' || $this->action == 'resend_verification')) {
			$this->Security->validatePost = false;
		}
			
			//for getting the user back to whence they came after logging in, using a whitelist for now
			if ($this->request->params['action']=='index'||$this->request->params['action']=='view'){
				//this doesn't work right when pages are preloaded with JQM - makes sense
				//but I am not sure what to do so thinking for awhile (rather not turn off preload but might have to)
				if (isset($this->params['url']['url'])) $current=Configure::read('globalSiteURL').$this->params['url']['url'];
				else $current=Configure::read('globalSiteURL');
				
				$this->Session->write('location',$current);
			}
		$this->set('totals',$this->Scorecard->scoreTotals(null,$user['id']));
		
		//Authenticate a kiosk user 
		if (Configure::read('enableKioskMode')==1){
			$user['id']='kioskUser';
			$user['username']='KioskUser';
			$user['provider']='kiosk';
			$this->Auth->login($user);
		}

	}
	

	public function blackhole($type) {
		//debug($type);
		//this logic needs to be changed, this is just for testing
		$this->Session->setFlash('blackhole '.$type,'flash_custom');
	}
	
	
	

}
