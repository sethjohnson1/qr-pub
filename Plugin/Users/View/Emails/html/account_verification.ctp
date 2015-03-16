<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 
 And also modified by Seth Johnson for iScout
 */

echo 'Hi '.$user[$model]['username'].',';
echo "\n";

//echo __d('users', 'to validate your account and login, you must visit the URL below within 24 hours');
echo "\n";
?>
Thanks for creating an iScout account! 
Just click the link below within 24 hours to validate your account and log in. 
Then as you tour you can comment and rate, earn postcards, and share the fun!
<?
echo "\n".Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'verify', 
'email', $user[$model]['email_token']), true);
echo "\n\n";
?>
If you did not create an account, simply delete this e-mail, OR, 
try out iScout for one session and let us know what you think! 
