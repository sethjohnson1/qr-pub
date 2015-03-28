<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CakeEmail', 'Network/Email');
App::uses('UsersAppController', 'Users.Controller');
//require_once 'src/Google_Client.php';
//require_once 'src/contrib/Google_Oauth2Service.php';

/**
 * Users Users Controller
 *
 * @package       Users
 * @subpackage    Users.Controller
 * @property	  AuthComponent $Auth
 * @property	  CookieComponent $Cookie
 * @property	  PaginatorComponent $Paginator
 * @property	  SecurityComponent $Security
 * @property	  SessionComponent $Session
 * @property	  User $User
 * @property	  RememberMeComponent $RememberMe
 */
class UsersController extends UsersAppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';

/**
 * If the controller is a plugin controller set the plugin name
 *
 * @var mixed
 */
	public $plugin = null;

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Time',
		'Text'
	);

/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'Paginator',
		'Security',
		'Users.RememberMe',
		'ExtAuth.ExtAuth',
		'Scorecard'
	);

/**
 * Preset vars
 *
 * @var array $presetVars
 * @link https://github.com/CakeDC/search
 */
	public $presetVars = true;

/**
 * Constructor
 *
 * @param CakeRequest $request Request object for this controller. Can be null for testing,
 *  but expect that features that use the request parameters will not work.
 * @param CakeResponse $response Response object for this controller.
 */
	public function __construct($request, $response) {
		$this->_setupComponents();
		parent::__construct($request, $response);
		$this->_reInitControllerName();
	}

/**
 * Providing backward compatibility to a fix that was just made recently to the core
 * for users that want to upgrade the plugin but not the core
 *
 * @link http://cakephp.lighthouseapp.com/projects/42648-cakephp/tickets/3550-inherited-controllers-get-wrong-property-names
 * @return void
 */
	protected function _reInitControllerName() {
		$name = substr(get_class($this), 0, -10);
		if ($this->name === null) {
			$this->name = $name;
		} elseif ($name !== $this->name) {
			$this->name = $name;
		}
	}

/**
 * Returns $this->plugin with a dot, used for plugin loading using the dot notation
 *
 * @return mixed string|null
 */
	protected function _pluginDot() {
		if (is_string($this->plugin)) {
			return $this->plugin . '.';
		}
		return $this->plugin;
	}

/**
 * Wrapper for CakePlugin::loaded()
 *
 * @throws MissingPluginException
 * @param string $plugin
 * @param boolean $exceiption
 * @return boolean
 */
	protected function _pluginLoaded($plugin, $exception = true) {
		$result = CakePlugin::loaded($plugin);
		if ($exception === true && $result === false) {
			throw new MissingPluginException(array('plugin' => $plugin));
		}
		return $result;
	}

/**
 * Setup components based on plugin availability
 *
 * @return void
 * @link https://github.com/CakeDC/search
 */
	protected function _setupComponents() {
		if ($this->_pluginLoaded('Search', false)) {
			$this->components[] = 'Search.Prg';
		}
	}

/**
 * beforeFilter callback
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		$this->_setupAuth();
		$this->_setupPagination();
		$this->set('model', $this->modelClass);
		$this->_setDefaultEmail();
	}

/**
 * Sets the default from email config
 *
 * @return void
 */
	protected function _setDefaultEmail() {
		if (!Configure::read('App.defaultEmail')) {
			$config = $this->_getMailInstance()->config();
			if (!empty($config['from'])) {
				Configure::write('App.defaultEmail', $config['from']);
			} else {
				Configure::write('App.defaultEmail', 'noreply@' . env('HTTP_HOST'));
			}
		}
	}

/**
 * Sets the default pagination settings up
 *
 * Override this method or the index action directly if you want to change
 * pagination settings.
 *
 * @return void
 */
	protected function _setupPagination() {
		$this->Paginator->settings = array(
			'limit' => 100,
			'conditions' => array(
				//sj commented out
				//$this->modelClass . '.active' => 1,
				//$this->modelClass . '.email_verified' => 1
			)
		);
	}

/**
 * Sets the default pagination settings up
 *
 * Override this method or the index() action directly if you want to change
 * pagination settings. admin_index()
 *
 * @return void
 */
	protected function _setupAdminPagination() {
		$this->Paginator->settings[$this->modelClass] = array(
			'limit' => 100,
			'order' => array(
				$this->modelClass . '.created' => 'desc'
			),
		);
	}

/**
 * Setup Authentication Component
 *
 * @return void
 */
	protected function _setupAuth() {
		if (Configure::read('Users.disableDefaultAuth') === true) {
			return;
		}

		//$this->Auth->allow('add', 'reset', 'verify', 'logout', 'view', 'reset_password', 'login', 'resend_verification');
		//sj - commented this out as we're handling it all in prefixes
		$this->Auth->allow('login','logout');

		if (!is_null(Configure::read('Users.allowRegistration')) && !Configure::read('Users.allowRegistration')) {
			$this->Auth->deny('add');
		}

		if ($this->request->action == 'register') {
			//sj - disabled because we will want registered users to register other users
			$this->Components->disable('Auth');
		} 

		if ($this->request->action == 'login') {
			$this->Auth->authenticate = array(
			'Form' => array(
				'fields' => array(
					'username' => 'email',
					'password' => 'password'),
				'userModel' => $this->_pluginDot() . $this->modelClass,
				'scope' => array(
					$this->modelClass . '.active' => 1,
					$this->modelClass . '.email_verified' => 1
				)
			));
		}
		
		

		$this->Auth->loginRedirect = '/';
		$this->Auth->logoutRedirect = array('plugin' => Inflector::underscore($this->plugin), 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginAction = array('admin' => false, 'plugin' => Inflector::underscore($this->plugin), 'controller' => 'users', 'action' => 'login');
	}
	


/* useful but not needed now
	public function index() {
		$this->set('users', $this->Paginator->paginate($this->modelClass));
	}
*/



 /*
	public function view($slug = null) {
		try {
			$this->set('user', $this->{$this->modelClass}->view($slug));
		} catch (Exception $e) {
			$this->Session->setFlash($e->getMessage(),'flash_custom');
			$this->redirect('/');
		}
	}
	


	public function edit() {
	}
*/

	public function admin_index() {
		if ($this->{$this->modelClass}->Behaviors->loaded('Searchable')) {
			$this->Prg->commonProcess();
			unset($this->{$this->modelClass}->validate['username']);
			unset($this->{$this->modelClass}->validate['email']);
			$this->{$this->modelClass}->data[$this->modelClass] = $this->passedArgs;
		}

		if ($this->{$this->modelClass}->Behaviors->loaded('Searchable')) {
			$parsedConditions = $this->{$this->modelClass}->parseCriteria($this->passedArgs);
		} else {
			$parsedConditions = array();
		}

		$this->_setupAdminPagination();
		
		$this->Paginator->settings[$this->modelClass]['conditions'] = $parsedConditions;
		//sj - added this
		$this->Paginator->settings[$this->modelClass]['recursive']=1;
		$users=$this->Paginator->paginate();
		$this->set('users', $this->Paginator->paginate());
	}


	public function admin_view($id = null) {
		if ($this->request->is('post')){
		//sj - remember validate false or it won't work!
			$this->User->create();
			if ($this->User->save($this->request->data,array('validate' => false))) {
				$this->Session->setFlash(__('Updated user info'));
			}
			else $this->Session->setFlash(__('Update failed!'));

		}
		
		//sj - removed old try / catch for this because it didn't work with social logins
		if (!$this->{$this->modelClass}->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		//using recursive 2 to get Template
		$options['recursive']=2;
		$options['contain']=array('CommentsUser','Comment'=>array('Template'));
		$user=$this->User->find('first', $options);
		$this->set('totals',$this->Scorecard->scoreTotals(null,$user['User']['id']));
		$this->set(compact('user'));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->request->data[$this->modelClass]['tos'] = true;
			$this->request->data[$this->modelClass]['email_verified'] = true;

			if ($this->{$this->modelClass}->add($this->request->data)) {
				$this->Session->setFlash(__d('users', 'The User has been saved'));
				$this->redirect(array('action' => 'index'));
			}
		}
		$this->set('roles', Configure::read('Users.roles'));
	}

/**
 * Admin edit
 *
 * @param null $userId
 * @return void
 */
	public function admin_edit($userId = null) {
		try {
			$result = $this->{$this->modelClass}->edit($userId, $this->request->data);
			if ($result === true) {
				$this->Session->setFlash(__d('users', 'User saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				unset($result[$this->modelClass]['password']);
				$this->request->data = $result;
			}
		} catch (OutOfBoundsException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'index'));
		}

		if (empty($this->request->data)) {
			$this->request->data = $this->{$this->modelClass}->read(null, $userId);
			unset($this->request->data[$this->modelClass]['password']);
		}
		$this->set('roles', Configure::read('Users.roles'));
	}

/**
 * Delete a user account
 *
 * @param string $userId User ID
 * @return void
 */
	public function admin_delete($userId = null) {
		if ($this->{$this->modelClass}->delete($userId)) {
			$this->Session->setFlash(__d('users', 'User deleted'));
		} else {
			$this->Session->setFlash(__d('users', 'Invalid User'));
		}

		$this->redirect(array('action' => 'index'));
	}

/**
 * Search for a user
 *
 * @return void
 */
 /*
	public function admin_search() {
		$this->search();
	}
	*/

/**
 * User register action
 *
 * @return void
 */
	public function add() {
		if ($this->Auth->user()) {
			$this->Session->setFlash('You are already registered and logged in!','flash_custom');
			$this->redirect('/');
		}
		

		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->register($this->request->data);
			if ($user !== false) {
				$Event = new CakeEvent(
					'Users.Controller.Users.afterRegistration',
					$this,
					array(
						'data' => $this->request->data,
					)
				);
				$this->getEventManager()->dispatch($Event);
				if ($Event->isStopped()) {
					$this->redirect(array('action' => 'login'));
				}

				$this->_sendVerificationEmail($this->{$this->modelClass}->data);
				$this->Session->setFlash('Your account has been created. You should receive an e-mail shortly to authenticate your account. Once validated you will be able to login.','flash_custom');
				$this->redirect(array('action' => 'login'));
			} else {
				unset($this->request->data[$this->modelClass]['password']);
				unset($this->request->data[$this->modelClass]['temppassword']);
				$this->Session->setFlash('Your account could not be created. Please, try again.','flash_custom');
			}
		}
	}

/**
 * Common login action
 *
 * @return void
 */
 
	public function login() {
		$Event = new CakeEvent(
			'Users.Controller.Users.beforeLogin',
			$this,
			array(
				'data' => $this->request->data,
			)
		);

		$this->getEventManager()->dispatch($Event);

		if ($Event->isStopped()) {
			return;
		}

		if ($this->request->is('post')) {		
			if ($this->Auth->login()) {
				$Event = new CakeEvent(
					'Users.Controller.Users.afterLogin',
					$this,
					array(
						'data' => $this->request->data,
						'isFirstLogin' => !$this->Auth->user('last_login')
					)
				);

				$this->getEventManager()->dispatch($Event);

				$this->{$this->modelClass}->id = $this->Auth->user('id');
				$this->{$this->modelClass}->saveField('last_login', date('Y-m-d H:i:s'));

				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = '/';
				}
				$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user($this->{$this->modelClass}->displayField)),'flash_custom');
				if (!empty($this->request->data)) {
					$data = $this->request->data[$this->modelClass];
					if (empty($this->request->data[$this->modelClass]['remember_me'])) {
						$this->RememberMe->destroyCookie();
					} else {
						$this->_setCookie();
					}
				}

				if (empty($data[$this->modelClass]['return_to'])) {
					$data[$this->modelClass]['return_to'] = null;
				}
				//debug($this->Auth->user());
				// Checking for 2.3 but keeping a fallback for older versions
				if (method_exists($this->Auth, 'redirectUrl')) {
				//sj - added this to redirect back to the last viewed template
					if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
					else $this->redirect($this->Auth->redirectUrl($data[$this->modelClass]['return_to']));
				} else {
					if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
					else $this->redirect($this->Auth->redirect($data[$this->modelClass]['return_to']));
				}
			} else {
				$this->Session->setFlash('Invalid e-mail / password combination. Please try again','flash_custom');
			}
		}
		if (isset($this->request->params['named']['return_to'])) {
			$this->set('return_to', urldecode($this->request->params['named']['return_to']));
		} elseif (isset($this->request->query['return_to'])) {
			$this->set('return_to', $this->request->query['return_to']);
		} else {
			$this->set('return_to', false);
		}
		$allowRegistration = Configure::read('Users.allowRegistration');
		$this->set('allowRegistration', (is_null($allowRegistration) ? true : $allowRegistration));
		//$this->render('login','ajax');
	}

/**
 * Search - Requires the CakeDC Search plugin to work
 *
 * @throws MissingPluginException
 * @return void
 * @link https://github.com/CakeDC/search
 */
	public function search() {
		$this->_pluginLoaded('Search');

		$searchTerm = '';
		$this->Prg->commonProcess($this->modelClass);

		$by = null;
		if (!empty($this->request->params['named']['search'])) {
			$searchTerm = $this->request->params['named']['search'];
			$by = 'any';
		}
		if (!empty($this->request->params['named']['username'])) {
			$searchTerm = $this->request->params['named']['username'];
			$by = 'username';
		}
		if (!empty($this->request->params['named']['email'])) {
			$searchTerm = $this->request->params['named']['email'];
			$by = 'email';
		}
		$this->request->data[$this->modelClass]['search'] = $searchTerm;

		$this->Paginator->settings = array(
			'search',
			'limit' => 100,
			'by' => $by,
			'search' => $searchTerm,
			'conditions' => array(
				'AND' => array(
					$this->modelClass . '.active' => 1,
					$this->modelClass . '.email_verified' => 1
				)
			)
		);

		$this->set('users', $this->Paginator->paginate($this->modelClass));
		$this->set('searchTerm', $searchTerm);
	}

/**
 * Common logout action
 *
 * @return void
 */
	public function logout() {
		$user = $this->Auth->user();
		$location=$this->Session->read('location');
		$this->Session->destroy();
		$this->RememberMe->destroyCookie();
		//$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged out'), $user[$this->{$this->modelClass}->displayField]));
		if (isset($location)) $this->redirect($location);
		else $this->redirect($this->Auth->logout());
	}

/**
 * Checks if an email is already verified and if not renews the expiration time
 *
 * @return void
 */
	public function resend_verification() {
		if ($this->request->is('post')) {
			try {
				if ($this->{$this->modelClass}->checkEmailVerification($this->request->data)) {
					$this->_sendVerificationEmail($this->{$this->modelClass}->data);
					$this->Session->setFlash('The email was resent. Please check your inbox.','flash_custom');
					$this->redirect('login');
				} else {
					$this->Session->setFlash('The email could not be sent. Please check errors.','flash_custom');
				}
			} catch (Exception $e) {
				$this->Session->setFlash($e->getMessage(),'flash_custom');
			}
		}
	}

/**
 * Confirm email action
 *
 * @param string $type Type, deprecated, will be removed. Its just still there for a smooth transistion.
 * @param string $token Token
 * @return void
 */
	public function verify($type = 'email', $token = null) {
		if ($type == 'reset') {
			// Backward compatiblity
			$this->request_new_password($token);
		}

		try {
			/*sj - added Auth-login here to save the trouble of having to log in again
			*/
			$user=$this->User->findByEmail_token($token);
			//debug($user);
			$this->{$this->modelClass}->verifyEmail($token);
			//unset all the fields saved in the previous function otherwise it will save the old info back during __doAuthLogin
			unset($user['User']['active']);
			unset($user['User']['email_verified']);
			unset($user['User']['email_token']);
			unset($user['User']['email_token_expires']);
			$user['User']['provider']='email';
			$this->__doAuthLogin($user);
			//$this->Session->setFlash('Your e-mail has been validated!','flash_custom');
			//return $this->redirect(array('action' => 'login'));
		} catch (RuntimeException $e) {
			$this->Session->setFlash($e->getMessage(),'flash_custom');
			//return $this->redirect('/');
		}
	}

/**
 * This method will send a new password to the user
 *
 * @param string $token Token
 * @throws NotFoundException
 * @return void
 */
	public function request_new_password($token = null) {
		if (Configure::read('Users.sendPassword') !== true) {
			throw new NotFoundException();
		}

		$data = $this->{$this->modelClass}->verifyEmail($token);

		if (!$data) {
			$this->Session->setFlash('The url you accessed is not longer valid','flash_custom');
			return $this->redirect('/');
		}

		if ($this->{$this->modelClass}->save($data, array('validate' => false))) {
			$this->_sendNewPassword($data);
			$this->Session->setFlash('Your password was sent to your registered email account','flash_custom');
			$this->redirect(array('action' => 'login'));
		}

		$this->Session->setFlash('There was an error verifying your account. Please check the email you were sent, and retry the verification link.','flash_custom');
		$this->redirect('/');
	}

/**
 * Sends the password reset email
 *
 * @param array
 * @return void
 */
	protected function _sendNewPassword($userData) {
		$Email = $this->_getMailInstance();
		$Email->from(Configure::read('App.defaultEmail'))
			->to($userData[$this->modelClass]['email'])
			->replyTo(Configure::read('App.defaultEmail'))
			->return(Configure::read('App.defaultEmail'))
			->subject(env('HTTP_HOST') . ' ' . __d('users', 'Password Reset'))
			->template($this->_pluginDot() . 'new_password')
			->viewVars(array(
				'model' => $this->modelClass,
				'userData' => $userData))
			->send();
	}

/**
 * Allows the user to enter a new password, it needs to be confirmed by entering the old password
 *
 * @return void
 */
	public function change_password() {
		if ($this->request->is('post')) {
			$this->request->data[$this->modelClass]['id'] = $this->Auth->user('id');
			if ($this->{$this->modelClass}->changePassword($this->request->data)) {
				$this->Session->setFlash('Password changed.','flash_custom');
				// we don't want to keep the cookie with the old password around
				$this->RememberMe->destroyCookie();
				$this->redirect('/');
			}
		}
	}

/**
 * Reset Password Action
 *
 * Handles the trigger of the reset, also takes the token, validates it and let the user enter
 * a new password.
 *
 * @param string $token Token
 * @param string $user User Data
 * @return void
 */
	public function reset_password($token = null, $user = null) {
		if (empty($token)) {
			$admin = false;
			if ($user) {
				$this->request->data = $user;
				$admin = true;
			}
			$this->_sendPasswordReset($admin);
		} else {
			$this->_resetPassword($token);
		}
	}

/**
 * Sets a list of languages to the view which can be used in selects
 *
 * @deprecated No fallback provided, use the Utils plugin in your app directly
 * @param string $viewVar View variable name, default is languages
 * @throws MissingPluginException
 * @return void
 * @link https://github.com/CakeDC/utils
 */
	protected function _setLanguages($viewVar = 'languages') {
		$this->_pluginLoaded('Utils');

		$Languages = new Languages();
		$this->set($viewVar, $Languages->lists('locale'));
	}

/**
 * Sends the verification email
 *
 * This method is protected and not private so that classes that inherit this
 * controller can override this method to change the varification mail sending
 * in any possible way.
 *
 * @param string $to Receiver email address
 * @param array $options EmailComponent options
 * @return void
 */
	protected function _sendVerificationEmail($userData, $options = array()) {
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('users', Configure::read('bitlyCampaign').' Account verification'),
			'template' => $this->_pluginDot() . 'account_verification',
			//'layout' => 'default',
			'layout' => '',
			'emailFormat' => 'html'
			//'emailFormat' => CakeEmail::MESSAGE_TEXT
		);

		$options = array_merge($defaults, $options);
				//debug();

		$Email = $this->_getMailInstance();
		$Email->to($userData[$this->modelClass]['email'])
			->from($options['from'])
			->emailFormat($options['emailFormat'])
			->subject($options['subject'])
			->template($options['template'], $options['layout'])
			->viewVars(array(
			'model' => $this->modelClass,
				'user' => $userData
			))
			->send();
	}

/**
 * Checks if the email is in the system and authenticated, if yes create the token
 * save it and send the user an email
 *
 * @param boolean $admin Admin boolean
 * @param array $options Options
 * @return void
 */
	protected function _sendPasswordReset($admin = null, $options = array()) {
		$defaults = array(
			'from' => Configure::read('App.defaultEmail'),
			'subject' => __d('users', 'Password Reset'),
			'template' => $this->_pluginDot() . 'password_reset_request',
			//'emailFormat' => CakeEmail::MESSAGE_TEXT,
			'emailFormat' => 'html',
			//'layout' => 'default'
			'layout' => ''
		);

		$options = array_merge($defaults, $options);

		if (!empty($this->request->data)) {
			$user = $this->{$this->modelClass}->passwordReset($this->request->data);
			
			if (!empty($user)) {
				if ($user[$this->modelClass]['email_verified'] == 1){
				$Email = $this->_getMailInstance();
				$Email->to($user[$this->modelClass]['email'])
					->from($options['from'])
					->emailFormat($options['emailFormat'])
					->subject($options['subject'])
					->template($options['template'], $options['layout'])
					->viewVars(array(
					'model' => $this->modelClass,
					'user' => $this->{$this->modelClass}->data,
						'token' => $this->{$this->modelClass}->data[$this->modelClass]['password_token']))
					->send();

				if ($admin) {
					$this->Session->setFlash('Instructions to reset the password have been sent.','flash_custom');
					$this->redirect(array('action' => 'index', 'admin' => true));
				} else {
					$this->Session->setFlash('You should receive an email with further instructions shortly','flash_custom');
					$this->redirect(array('action' => 'login'));
				}
				}
				else {
					$this->Session->setFlash('Your e-mail has not been verified.','flash_custom');
					$this->redirect(array('action'=>'resend_verification'));
				}
			}
			
			else {

				$this->Session->setFlash('No user was found with that email.','flash_custom');
				$this->redirect($this->referer('/'));
			}
		}
		$this->render('request_password_change');
	}

/**
 * Sets the cookie to remember the user
 *
 * @param array RememberMe (Cookie) component properties as array, like array('domain' => 'yourdomain.com')
 * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
 * @return void
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/cookie.html
 */
	protected function _setCookie($options = array(), $cookieKey = 'rememberMe') {
		$this->RememberMe->settings['cookieKey'] = $cookieKey;
		$this->RememberMe->configureCookie($options);
		$this->RememberMe->setCookie();
	}

/**
 * This method allows the user to change his password if the reset token is correct
 *
 * @param string $token Token
 * @return void
 */
	protected function _resetPassword($token) {
		$user = $this->{$this->modelClass}->checkPasswordToken($token);
		if (empty($user)) {
			$this->Session->setFlash('Invalid password reset token, try again.','flash_custom');
			$this->redirect(array('action' => 'reset_password'));
			return;
		}

		if (!empty($this->request->data) && $this->{$this->modelClass}->resetPassword(Hash::merge($user, $this->request->data))) {
			if ($this->RememberMe->cookieIsSet()) {
				$this->Session->setFlash('Password changed.','flash_custom');
				$this->_setCookie();
			} else {
				$this->Session->setFlash('Password changed, you can now login with your new password.','flash_custom');
				$this->redirect($this->Auth->loginAction);
			}
		}

		$this->set('token', $token);
	}

/**
 * Returns a CakeEmail object
 *
 * @return object CakeEmail instance
 * @link http://book.cakephp.org/2.0/en/core-utility-libraries/email.html
 */
	protected function _getMailInstance() {
		return $this->{$this->modelClass}->getMailInstance();
	}

/**
 * Default isAuthorized method
 *
 * This is called to see if a user (when logged in) is able to access an action
 *
 * @param array $user
 * @return boolean True if allowed
 * @link http://book.cakephp.org/2.0/en/core-libraries/components/authentication.html#using-controllerauthorize
 */
	public function isAuthorized($user = null) {
		return parent::isAuthorized($user);
	}

	
	public function dummyAuth($id){
	//great for testing.. Don't want it working in production
		if (Configure::read('debug')>0){
			$fuser=$this->User->findById(5);
			$user['id']=$id;
			$user['username']='BigDummyTestUser'.$id;
			$user['provider']='Twitter';
			//$user['upvotes']=null;
			//$user['downvotes']=null;
			//$user['flagged']=null;
			
			//$this->Auth->login($fuser['User']);
			$this->Auth->login($user);
			if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
			else $this->redirect('/');
		}
	}
	
	
	//now for the ExtAuth stuff and Google
	
	public function auth_login($provider) {
		$result = $this->ExtAuth->login($provider);
		if ($result['success']) {

			$this->redirect($result['redirectURL']);

		} else {
			$this->Session->setFlash($result['message'],'flash_custom');
			$this->redirect($this->Auth->loginAction);
		}
	}
	
	public function auth_callback($provider) {
		$result = $this->ExtAuth->loginCallback($provider);
		if ($result['success']) {

			$this->__successfulExtAuth($result['profile'], $result['accessToken']);

		} else {
			$this->Session->setFlash($result['message'],'flash_custom');
			$this->redirect($this->Auth->loginAction);
		}
	}
	
	//sj -added this when ExtAuth plugin quit working with Google
	public function gauth() {
		//good help here: http://www.sanwebe.com/2012/11/login-with-google-api-php
		//include google api files - sj will try to clean up to only files I modified - moving forward for now
		//the src is in webroot folder
		require_once 'gauth/src/Google_Client.php';
		require_once 'gauth/src/contrib/Google_Oauth2Service.php';

		$gClient = new Google_Client();
		$gClient->setApplicationName('iScout Tour');
		$gClient->setClientId(Configure::read('ExtAuth.Provider.Google.key'));
		$gClient->setClientSecret(Configure::read('ExtAuth.Provider.Google.secret'));
		$gClient->setRedirectUri(Configure::read('globalSiteURL').'/users/gauth');

		$google_oauthV2 = new Google_Oauth2Service($gClient);

		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code'])) 
		{ 
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var(Configure::read('globalSiteURL').'/users/gauth', FILTER_SANITIZE_URL));
			return;
		}


		if (isset($_SESSION['token'])) 
		{ 
			$gClient->setAccessToken($_SESSION['token']);
		}


		if ($gClient->getAccessToken()) 
		{
			  //For logged in user, get details from google using access token
			  $user 				= $google_oauthV2->userinfo->get();
			  $_SESSION['token'] 	= $gClient->getAccessToken();
			  //rejoin the party here, after a little fix-up to match the way everything else was working
			  $user['oid']='https://plus.google.com/'.$user['id'];
			 $this->__successfulExtAuth($user, $_SESSION['token']);
		}
		else 
		{
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
			$this->redirect($authUrl);
		}
		//debug($user);
		$this->set(compact('authUrl'));
	
	}
	
	
	private function __successfulExtAuth($incomingProfile, $accessToken) {
		$user=$this->User->findByOid($incomingProfile['oid']);
		if ($user) {
			$this->__doAuthLogin($user);
		}
		else {
		//make a new account, not much needs to be done with the data the fields were named for the API calls
			//ensure username is unique - or maybe we just remove this constraint?
			$an=preg_replace("/[^A-Za-z0-9]/", '', $incomingProfile['oid']);
			$incomingProfile['username']=$incomingProfile['given_name'].'_'.substr($incomingProfile['family_name'],0,1).'^'.$an;
			
			//just get rid of email validation and skip it
			$this->User->validator()->remove('email');

			//not sure about this, it works fine without them, but they do not show on User list in index 
			//$user['email_verified']=1;
			//$user['tos']=1;
			//$user['active']=1;
			$incomingProfile['ip'] = $_SERVER["REMOTE_ADDR"]; 
			$uuid=String::uuid();
			$incomingProfile['id']=$uuid;
			
			if ($this->User->save($incomingProfile)){
				$user['User']=$incomingProfile;
				$this->__doAuthLogin($user);
			}
			else {
				$this->Session->setFlash('Something has gone wrong. Please try again or contact the system admin.','flash_custom');
				debug($this->User->invalidFields());
			}
		}
		//debug($incomingProfile);
	}
	
	
	//this is used by ExtAuth AND by the email token login AND gauth
	private function __doAuthLogin($user) {
		if ($this->Auth->login($user['User'])) {
			$user['User']['last_login'] = date('Y-m-d H:i:s');
			if (is_null($user['User']['given_name'])) $user['User']['given_name']=$user['User']['username'];
			//fails validation otherwise
			unset($user['User']['password']);
			$this->User->validator()->remove('email');
			$this->User->validator()->remove('tos');
			if ($this->User->save($user['User'])){
				$this->Session->setFlash('Thanks '.$user['User']['given_name'].'! You are logged in.','flash_custom');
				
				if ($this->Session->read('location')) $this->redirect($this->Session->read('location'));
				else $this->redirect('/');
			}
			else {
				$this->Session->setFlash('Something has gone wrong. Please try again or contact the system admin.','flash_custom');
				debug($this->User->invalidFields());
			}
		}
	}

}
