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

//echo __d('users', 'A request to reset your password was sent. To change your password click the link below.');
//echo "\n";
//echo Router::url(array('admin' => false, 'plugin' => 'users', 'controller' => 'users', 'action' => 'reset_password', $token), true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>password-reset-request</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

	<style>
	tr {
	background-color:#ede9e7; 
	font-family: Verdana,sans-serif;
	padding:20px;
	border-width:1px;
	border-style: solid ;
	border-color: #aa9c8f;
	width:100%;
	}
	h3 {
	color:#766a62;
	}
	h4 {
	color:#bd4f19;
	}
	p {
	color:#766a62;
	}
	a {
	color:#bd4f19;
	}
	</style>

	<body>
		<!-- E-mail header:
		iScout Tour, Buffalo Bill Center of the West
		From: iscout@centerofthewest.org
		To: [e-mail address]
		Date: 
		Subject: Reset your iScout password -->
	
	<div style="
		background-color:#ede9e7; 
	font-family: Verdana,sans-serif;
	padding:20px;
	border-width:1px;
	border-style: solid ;
	border-color: #aa9c8f;
	width:100%;
	">
		<h3 style="color: #766a62;">Hello,</h3>
		<p>iScout received a request from this e-mail address to reset your password. Click the link below and let's take care of it!</p>
		<h4>
		<?=Router::url(array('admin' => false, 'plugin' => 'users',
		'controller' => 'users', 'action' => 'reset_password', $token), true);

		?>
		
		</h4>
		<p>If you received this e-mail in error, simply delete it.</p>
		<h4>Happy iScouting!</h4>
		<img src="iScout-Icon-small.gif"/>
	</div>
	
	</body>
</html>