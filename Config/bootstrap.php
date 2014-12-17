<?php


Cache::config('default', array('engine' => 'File'));

 
 // Code below is as suggested on http://mark-story.com/posts/view/installing-cakephp-with-composer

// Load composer autoload.
require APP . 'Vendor/autoload.php';
// Remove and re-prepend CakePHP's autoloader as composer thinks it is the most important.
// See https://github.com/composer/composer/commit/c80cb76b9b5082ecc3e5b53b1050f76bb27b127b
spl_autoload_unregister(array('App', 'load'));
spl_autoload_register(array('App', 'load'), true, true);

//likely will not need
//CakePlugin::load('HybridAuth', array('bootstrap' => true));

 CakePlugin::load(array('DebugKit','Search','Utils'));
 CakePlugin::load('Users',array('routes'=>true));
CakePlugin::load('ExtAuth');



Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

/**
 * Private unified config 
 */


App::uses('PhpReader', 'Configure');
if (file_exists(ROOT . DS . APP_DIR . DS . 'Config' . DS . 'private.php')) {
  Configure::config('default', new PhpReader());
  Configure::load('private');
}
else {
  echo 'ROOT: '.ROOT.'<br>';
  echo 'APP_DIR: '.APP_DIR.'<br>';
  throw new CakeException('ROOT/APP_DIR/Config/private.php not found.  You must create this file from the template APP_DIR/Config/private_sample.php');
}
