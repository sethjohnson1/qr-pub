<div id="userPopup" data-theme="a">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div style="padding:10px 20px;">
	<?
	$width='300px;';
	if (!$this->Session->read('Auth.User.id')) : 
	echo '	<h3 align=center>Super-Easy Login:</h3>';
		echo $this->Html->link('Facebook',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Facebook'),array(
			'data-role'=>'button',
			'data-theme'=>'b',
			'rel'=>'external'
			));
		echo $this->Html->link('Google',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Google'),array(
			'data-role'=>'button',
			'data-theme'=>'c',
			'rel'=>'external'
			));
		echo $this->Html->link('Twitter',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Twitter'),array(
			'data-role'=>'button',
			'data-theme'=>'d',
			'rel'=>'external'
			));
			
	
		
		?>
		<h3 align=center>- OR -</h3>
		<?
		echo $this->Html->link('Create an Account with e-mail',array('plugin'=>'users','controller'=>'users','action'=>'add'),array(
			'data-role'=>'button'
			));
		?>

		
		<?
		else :
		if ($this->request['action']=='view'){
		?>
		<h3>Tell everyone how awesome your vacation is by sharing a link to this page.</h3>
		<?
	
			if ($user['provider']=='Twitter'){
				echo $this->Html->link('Tweet','https://twitter.com/share?via=centerofthewest&hastags=iscout&text='.'formdat!'.'&url='.$shorturl, array(
					'data-role'=>'button',
					'data-theme'=>'d'
				));
			}
			if ($user['provider']=='Facebook'){
				echo $this->Html->link('Post to Facebook','http://www.facebook.com/share.php?u='.$shorturl, array(
					'data-role'=>'button',
					'data-theme'=>'b',
					'target'=>'_blank'
				));
			}
			if ($user['provider']=='Google'){
				echo $this->Html->link('Google+','https://plus.google.com/share?url='.$shorturl, array(
					'data-role'=>'button',
					'data-theme'=>'c',
					'target'=>'_blank'
				));
			}
			//
			if ($user['provider']=='email'){
				?>
				<h3>We'll e-mail you a pre-formatted message that you can forward on.</h3>
				<?
				echo $this->Html->link('E-mail me',array('controller'=>'templates','action'=>'email',$template['Template']['id'],urlencode($shorturl)), array(
					'data-role'=>'button',
					'data-theme'=>'e',
					'data-ajax'=>'false'
				));
			}
		}
		else{
			?> <h3>You are currently logged in. When this button is illuminated you can use it to share parts of the tour.</h3> <?
		}
		
		echo $this->Html->link('Log out',array('plugin'=>'users','controller'=>'users','action'=>'logout'),array(
			//'data-role'=>'button',
			'rel'=>'external' //? not sure if needed here
			));
		endif; ?>

		</div>

</div>