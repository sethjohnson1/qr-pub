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
 
 // sj- this is where I left off, look to line 311-ish of UsersController
 echo $this->Form->create();
 echo $this->Form->input('engaged');
 echo $this->Form->end('Save');
?>
	
	
	<h2><?=$user[$model]['username'].' via '.$user[$model]['provider']?></h2>
	
	<ul>
		<li>Created: <?=$user[$model]['created'] ?></li>
		<? //make this a link eventually ?>
		<li>OID: <?=$user[$model]['oid'] ?></li>
		<li>Full name: <?=$user[$model]['given_name'].' '.$user[$model]['family_name'] ?></li>
		<li>Gender: <?=$user[$model]['gender']?></li>
		<li>Email: <?=$user[$model]['email']?></li>
	</ul>
	<h3>Compelled to say</h3>
	<ul>
	<? foreach($user['Comment'] as $key=>$value):?>
	<li>
		<?
		echo $this->Html->link($value['template_id'],array('admin'=>false,'plugin'=>'',
			'controller'=>'templates',
			'action'=>'view',$value['template_id']
			)).' - '.
		$this->Html->link($value['thoughts'],'#');
		?>
	</li>
	<?endforeach?>
	</ul>
<? debug($user); ?>

	
