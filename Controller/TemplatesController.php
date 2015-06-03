<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class TemplatesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$templates=array(
			'splash'=>'Splash image','video'=>'Video page','blog'=>'Blog post',
			'vgal'=>'Virtual gallery',
			'ag'=>'AcoustiGuide',
			'tn'=>'Vgal XML injection',
			'element'=>'Elemental Conjuring'
		);
		$locations=array('BBM'=>'Buffalo Bill Museum','CFM'=>'Cody Firearms Museum','DMNH'=>'Draper Natural History Museum','Garden'=>'Garden Areas',
		'HMRL'=>'McCracken Research Library','PIM'=>'Plains Indian Museum','WG'=>'Whitney Western Art Museum','NW'=>'Nowhere');
		$this->set(compact('templates','locations'));
		$this->set('meta_description', 'Digital and Virtual tour of the Buffalo Bill Center of the West.');
	}
	
	public $components = array('Paginator','Comment','Scorecard','Search.Prg');
	
	public function browse() {
		$stops=array();
		//may want to add another condition such as "prev id is null" if there are lots of chained templates
		//for now just get all of them!
		foreach ($this->viewVars['locations'] as $key=>$location){
		if ($key=='NW') continue;
			$stops[$key]=$this->Template->find('all',array(
			'conditions'=>array('Template.active'=>1,'Template.location'=>$key,'Template.previd is null'),
			'recursive'=>-1));
		}
		$this->set(compact('stops'));
		$this->set('title_for_layout', 'Browse');
		
		//$this->render('browse','default');
	}
	
	
	public function about() {
		//basically a static page but we might need some variables.. who knows.
		$this->set('title_for_layout','About');
	}
	
	public function scorecard() {
		$this->loadModel('Rank');
		$user=$this->Auth->user();
		$dbranks=$this->Rank->find('all');
		$this->set(compact('dbranks','test'));
		$this->set('title_for_layout','Score Card');
	}
	
	public function postcard($crypt=null) {
		$user=$this->Auth->user();
		if ($this->request->is('post')){
			//first strip tags, otherwise we're welcoming some interesting Spam
			$this->request->data['Template']['name']=strip_tags($this->request->data['Template']['name'], '<em><strong>');
			$this->request->data['Template']['message']=strip_tags($this->request->data['Template']['message'], '<em><strong>');
			
			//do some crazy URL-engineering, I split this on several lines to make it easy to understand
			$key = Configure::read('Security.salt');
			$data=json_encode($this->request->data['Template']);
			$value= gzdeflate(Security::encrypt($data,$key),9);
			$value=urlencode($value);
			$this->set('prgdata',$this->request->data);
			//also write a cookie
			$this->Cookie->write('postcard_crypt',$value);
			$this->redirect(array('action'=>'postcard',$value));	
			
		}
		if (isset($crypt)){
			if ($crypt=='clear'){
				$this->Cookie->delete('postcard_crypt');
				$this->redirect(array('action'=>'postcard'));
			}
			//reverse the crazy-long URL
			$cryptdata=json_decode(Security::decrypt(gzinflate(urldecode($crypt)),Configure::read('Security.salt')),true);
		}
		$this->loadModel('Rank');
		$user=$this->Auth->user();
		$dbranks=$this->Rank->find('all');
		$this->set(compact('dbranks','test','crypt','cryptdata','user'));
		$this->set('title_for_layout','My Postcards');
		$this->set('shorturl',$this->UrlShortener->get_bitly_short_url($this->here,'social',$user['provider']));
	}
	
	public function feedback() {
		if ($this->request->is('post')) {
			//send an e-mail reads addresses from private config file
			$Email = new CakeEmail();
			$Email->from(Configure::read('globalFromEmail'))
				->to(Configure::read('globalAdminEmail'))
				->subject('iScout Feedback')
				->send(
				"From: ".$this->request->data['Feedback']['email']."\n\n\n".
				$this->request->data['Feedback']['message']
				);
			//$this->render(false);
			$this->Session->setFlash('Your message was sent! Thank you.','flash_custom');
			
			if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
			else $this->redirect('/');
		}
		$this->set('title_for_layout','Offer Feedback');
	}

	//$id is the template id
	public function code_button($id=null,$code=null) {
		//got here from ajax
		if (!empty($code)){
			if ($id !=0){
				$this->Session->setFlash('Viewing Code '.$code,'flash_custom');
				return $this->redirect(array('controller'=>'templates','action'=>'view',$id));
			}
			else {
				$this->Session->setFlash('Sorry, code '.$code.' did not work','flash_custom');
				return $this->redirect($this->referer());
			}
		}
		if ($this->request->is('post') || $this->request->is('ajax')) {
			if (isset($this->request->data['Code']['3digitcode'])){
				$template_redir=$this->Template->find('first',array(
					'conditions'=>array('Template.code'=>$this->request->data['Code']['3digitcode']),
					'recursive'=>-1
				));
				
				if (!isset($template_redir['Template']['id'])) {
					$template_redir['Template']['id']=0;
				}

				//just build URL here, as it redirects back here anyway
				$this->set('content',$template_redir['Template']['id'].'/'.$this->request->data['Code']['3digitcode']);
				$this->render('ajax_response', 'ajax');	

			}
		}
	}

	public function view($id = null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
		$template=$this->Template->find('first', $options);
		$user=$this->Auth->user();
		if (isset($user)) $this->set('user',$user);
		else {
			$user['id']=null;
			$user['provider']=null;
		}
		//user Comments component to load up view variables
		$comments=$this->Comment->getComments($id,$user['id']);
		$usercomment=$this->Comment->userComment($id,$user['id']);
		//override AppController value
		if (!isset($template['Template']['previd'])) $totals=$this->Scorecard->scoreTotals($template,$user['id']);
		else $totals['totals']='';
		//debug($totals);
		//now do some counting for overlays
		$total=0;
		$score=0;
		if (!empty($totals['totals'])){
			foreach ($totals['totals'] as $val)	$total=$val+$total;
			foreach ($totals['counts'] as $val)	$score=$val+$score;
			//now 0 to 5 score
			$starrating=round(($score/$total)/.2);
			$lastrating=$this->Cookie->read('lastrating');
			if (!isset($lastrating)) $lastrating=0;
			if ($starrating > $lastrating){
				$this->Cookie->write('lastrating',$starrating);
				$this->set('show',1);
			}
		}

		$this->set(compact('user','comments','template','usercomment','template_redir','totals','id','starrating','lastrating'));
		
		//URL shortener - will return BAD_REQUEST unless on live domain
		$this->set('shorturl',$this->UrlShortener->get_bitly_short_url($this->here,'social',$user['provider']));									
		$this->set('title_for_layout', $template['Template']['meta_title']);
		//the description does not need to be set here, but in the individual templates (see vgal)
		//$this->render('view','default');
	}
	public function clear_card() {
		$user=$this->Auth->user();
		if (isset($user)) {
			$this->loadModel('Scorecard');
			$this->Scorecard->deleteAll(array("Scorecard.id LIKE '".$user['id']."_%'"), false);
		}
		$this->Cookie->delete('counts');
		$this->Cookie->delete('lastrating');
		$this->redirect(array('controller'=>'templates','plugin'=>'','action'=>'scorecard'));
	}
	
	/*
	sends an e-mail via userPopup, at this point it is very basic, I think I'll wait until
	someone else wants to help with this, as I doubt it will get used much
	*/
	public function email($id=null,$url=null,$title=null,$name=null){
		//uses View/Email/text/email_me_share
		$Email = new CakeEmail();
		$Email->config('default');
		$Email->to($this->Auth->user('email'))
			//->from(Configure::read('App.defaultEmail'))
			->emailFormat('html')
			->subject('iScout Virtual Tour from '.urldecode($name))
			->template('email_me_share')
			->viewVars(array(
				'url' => urldecode($url),
				'title' => urldecode($title)
			))
			->send();
		//$this->render(false);
		$this->Session->setFlash('Your message was sent! Thank you.','flash_custom');
		$this->redirect($this->referer());
	}

	//I don't think this is used any longer
	public function commentbutton() {
		//if ($this->request->is('ajax')){
			//$this->set('content', $thread[0]->id); 
			$this->set('content', $data);
			$this->render('ajax_response', 'ajax');
		//}
    }

	public function admin_view($id = null,$creator=null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		$options['conditions'] = array('Template.' . $this->Template->primaryKey => $id);
		$options['recursive']= 2;
		$template=$this->Template->find('first', $options);
		$this->set(compact('template', 'creator'));
	}
	
	public function admin_add($creator=null) {
		if ($this->request->is('post')) {
			$this->Template->create();
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','admin'=>true,'action' => 'add',$this->request->data['Template']['name'],$this->Template->getLastInsertID(),$creator));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again.'));
			}
			
		}
		$this->set(compact('creator'));
		//$this->render('admin_add','default');
	}


	public function admin_edit($id = null,$creator=null) {
		if (!$this->Template->exists($id)) {
			throw new NotFoundException(__('Invalid template'));
		}
		if ($creator != Configure::read('globalSuperUser')&& !$this->Template->find('first',array(
			'conditions'=>array('Template.creator'=>$creator,'Template.id'=>$id)
		))){
			throw new NotFoundException(__('Invalid creator. Check your URL and try again.'));
		};
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Template->save($this->request->data)) {
				$this->Session->setFlash(__('The template has been saved.'));
				return $this->redirect(array('controller'=>'assets','admin'=>true,'action' => 'add',$this->request->data['Template']['name'],$id,$creator));
			} else {
				$this->Session->setFlash(__('The template could not be saved. Please, try again. Double-check Creator and nextid'));
			}
		} else {
			$options = array('conditions' => array('Template.' . $this->Template->primaryKey => $id));
			$this->request->data = $this->Template->find('first', $options);
		}
		$this->set('edit',true);
		$this->set(compact('edit','creator'));
		
		//add 'ajax' here to help with debugging
		$this->render('admin_add','default');
	}
	
	public function admin_index($creator=null) {
		$this->Prg->commonProcess();
		$this->Template->recursive = 0;
		$limit=100;
		//superuser sees all!
		if ($creator==Configure::read('globalSuperUser')){
			$this->paginate = array('limit'=>$limit,'conditions' => $this->Template->parseCriteria($this->Prg->parsedParams()));
		}
		else {
			$this->paginate = array('limit'=>$limit,'conditions' => array($this->Template->parseCriteria($this->Prg->parsedParams()),
			'AND'=>array('Template.creator'=>$creator)));
		}
		//no error handling needed, the paginator will just be empty
		$templates=$this->Paginator->paginate();
		$user=$this->Auth->user();
		$totals=$this->Scorecard->scoreTotals(null,$user['id']);
		$this->set(compact('templates','totals','creator'));
		//$this->render('admin_index','default');

	}
	
	public function admin_login(){
		if ($this->request->is(array('post'))) {
			return $this->redirect(array('admin'=>true,'controller'=>'templates',
				'action' => 'index',$this->request->data['Login']['username']));
		}	
	}


	public function admin_delete($id = null,$creator=null) {
	//there is no security around this other than no one knows about it (aside from the normal admin prefix security)
	if ($creator==Configure::read('globalSuperUser')){
		$this->Template->id = $id;
		if (!$this->Template->exists()) {
			throw new NotFoundException(__('Invalid template'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Template->delete()) {
			$this->Session->setFlash(__('The template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The template could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index',$creator));
	}
	else throw new NotFoundException(__('Improper prefix'));
	}
	
}
