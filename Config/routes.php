<?php
	Router::redirect('/templates/', array('controller' => 'templates', 'action' => 'index'));
	Router::redirect('/templates', array('controller' => 'templates', 'action' => 'index'));
	Router::connect('/', array('controller' => 'templates', 'action' => 'index'));
	Router::connect('/auth_login/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_login'));
	Router::connect('/auth_callback/*', array( 'plugin'=>'users','controller' => 'users', 'action' => 'auth_callback'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
