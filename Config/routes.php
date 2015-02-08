<?php
	//Router::redirect('/admin/templates/', array('admin'=>true,'controller' => 'templates', 'action' => 'index'));
	//Router::redirect('/admin/templates', array('admin'=>true,'controller' => 'templates', 'action' => 'index'));
	Router::connect('/', array('controller' => 'templates', 'action' => 'view',Configure::read('defaultTemplate')));
	Router::connect('/admin', array('admin'=>true,'controller' => 'templates', 'action' => 'login'));
	Router::connect('/auth_login/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_login'));
	Router::connect('/auth_callback/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_callback'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
