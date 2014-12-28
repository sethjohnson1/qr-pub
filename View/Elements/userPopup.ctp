<div id="userPopup" data-theme="a">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div style="padding:10px 20px;">
	<?
	//just quick rendition, all these buttons need some styling
	$width='300px;';
	if (!$this->Session->read('Auth.User.id')) : 
	echo '	<h3 align=center>Super-Easy Login:</h3>';
		echo $this->Html->link('Facebook',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Facebook'),array(
			'data-role'=>'button',
			'rel'=>'external',
			'style'=>'width: '.$width,
			));
		echo $this->Html->link('Google',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Google'),array(
			'data-role'=>'button',
			'rel'=>'external'
			));
		echo $this->Html->link('Twitter',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Twitter'),array(
			'data-role'=>'button',
			'rel'=>'external'
			));
			
	
		
		?>
		<h3 align=center>- OR -</h3>
		<?
		echo $this->Html->link('Create an Account',array('plugin'=>'users','controller'=>'users','action'=>'add'),array(
			'data-role'=>'button'
			));
		?>

		
		<?else : ?>
		<h3>You're already logged in, sharing icons should go here maybe.</h3>
		
		<?
		//debug($this->Session->read('Auth.User'));
		echo $this->Html->link('Log out',array('plugin'=>'users','controller'=>'users','action'=>'logout'),array(
			'data-role'=>'button',
			'rel'=>'external' //? not sure if needed here
			));
		endif; ?>

		</div>

</div>