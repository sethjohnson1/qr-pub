<?
//make a unique ID for Popup if on a template page
if (!isset($template['Template']['id'])) $template['Template']['id']=$this->params['action'];
?>
<div id="userPopup<?=$template['Template']['id']?>" data-theme="a" data-overlay-theme="a" data-role="popup">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
	<div style="padding:10px 20px;">
	<?
	$width='300px;';
	if (!$this->Session->read('Auth.User.id')) : 
	echo '	<h3 align=center>Super-Easy Login:</h3>';
		echo $this->Html->link('Facebook',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Facebook'),array(
			'data-role'=>'button',
			'data-theme'=>'b',
			'rel'=>'external',
			'class'=>'socialbutton',
			'data-icon'=>'iscout-whitefbicon'
			));
		echo $this->Html->link('Google',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Google'),array(
			'data-role'=>'button',
			'data-theme'=>'c',
			'rel'=>'external',
			'class'=>'socialbutton',
			'data-icon'=>'iscout-whitegoogleplusicon'
			));
		echo $this->Html->link('Twitter',array('plugin'=>'users','controller'=>'users','action'=>'auth_login','Twitter'),array(
			'data-role'=>'button',
			'data-theme'=>'d',
			'rel'=>'external',
			'class'=>'socialbutton',
			'data-icon'=>'iscout-whitetwittericon'
			));
			
	
		
		?>
		<h3 align=center>- OR -</h3>
		<?
		echo $this->Html->link('Create an Account with e-mail',array('plugin'=>'users','controller'=>'users','action'=>'add'),array(
			'data-role'=>'button','data-theme'=>'f'
			));
		?>
		
		<script>
		$( ".socialbutton" ).click(function() {
			$.mobile.loading( 'show', {
				text: 'Logging in...',
				textVisible: true,
				theme: 'a',
				html: ""
			}); 
			});
		</script>

		
		<?
		//pay attention to nested IF here . . .
		else :
			if ($this->request['action']=='view' || $this->request['action']=='postcard'){
			if ($this->request['action']=='postcard'){
			?>
			
			<h3>Share a persistent link to all your postcards, including your special message</h3>
			<?
			}
			else{
		?>
		<h3>Tell everyone how awesome your vacation is by sharing a link to this page.</h3>
		<?
			}
			echo $this->element('social_buttons');
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