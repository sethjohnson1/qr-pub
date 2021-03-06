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
		//don't give any hints
		else $this->redirect('/');
		
		
		//users plugin blackhole fix, started somewhere in CakePHP 2.5.3
		if (isset($this->Security) && ( $this->action == 'login' || $this->action == 'reset_password' || $this->action == 'resend_verification')) {
			$this->Security->validatePost = false;
		}
			
			//for getting the user back to whence they came after logging in, using a whitelist for now
			//the 'next' query string is to prevent JQM prefetch from writing session variable
			if (($this->request->params['action']=='index'||$this->request->params['action']=='view')
				&& (!isset($this->request->query['next']))
			){
				//this doesn't work right when pages are preloaded with JQM - makes sense
				//but I am not sure what to do so thinking for awhile (rather not turn off preload but might have to)
				if (isset($this->params['url']['url'])) $current=Configure::read('globalSiteURL').$this->params['url']['url'];
				else $current=Configure::read('globalSiteURL');
				
				$this->Session->write('location',$current);
			}
			//debug($this->request->query['next']);
		$this->set('totals',$this->Scorecard->scoreTotals(null,$user['id']));
		
		//this must be set to variable to avoid errors when checking for empty
		$kioskmode=Configure::read('enableKioskMode');
		
		//Authenticate a kiosk user - very basic right now
		if (!empty($kioskmode)){
			$user['id']='kiosk_'.$kioskmode;
			$user['username']='Museum Visitor';
			$user['provider']='kiosk';
			$this->Auth->login($user);
		}
	/* define colors, useful for Scorecard and Postcard at the moment */
		$colors=array(
			'BBM'=>'#6e3219',
			'CFM'=>'#004250',
			'DMNH'=>'#035642',
			'WG'=>'#981e32',
			'PIM'=>'#bd4f19',
			'HMRL'=>'#532e60',
			'Garden'=>'#c59217',
			'tan'=>'#aa9c8f',
			'NW'=>'#aa9c8f'
		);
		$bbm='#6e3219';
		$cfm='#004250';
		$dmnh='#035642';
		$wg='#981e32';
		$pim='#bd4f19';
		$hmrl='#532e60';
		$garden='#c59217';
		$tan='#aa9c8f';
		$this->set(compact('bbm','cfm','dmnh','wg','pim','hmrl','garden','colors','kioskmode'));
		
		//write the postcard cookie
		$this->set('postcard_crypt',$this->Cookie->read('postcard_crypt'));
	}
	
	public function blackhole($type) {
		//debug($type);
		//this logic needs to be changed, this is just for testing
		$this->Session->setFlash('blackhole '.$type,'flash_custom');
	}
}
