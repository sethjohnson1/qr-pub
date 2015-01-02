	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<!--right here we need 2 pull out Qs that 1 for score card and 1 for comments, then also design those panels-->
		<div data-role="navbar">
			<ul>
			<?php if (!$this->Session->read('Auth.User.id')) : ?>
			<li>
			<?php echo $this->Html->link('Login', array('plugin' => 'users',
			'controller' => 'users', 'action' => 'login'),
			array('data-icon'=>'user')); ?>
			</li>
				<?php if (!empty($allowRegistration) && $allowRegistration) : ?>
			<li><?php echo $this->Html->link(('Register an account'), array('plugin' => 'users',
			'controller' => 'users', 'action' => 'add'),
			array('data-icon'=>'plus')); 
			?></li>
		<?php endif; ?>
		<?php else : ?>
			<li><?php echo $this->Html->link('Logout', array('plugin' => 'users', 'controller' => 'users',
			'action' => 'logout'),
			array('data-icon'=>'delete')); ?>
			<li><?php echo $this->Html->link('Change password', array('plugin' => 'users', '
			controller' => 'users', 'action' => 'change_password'),
			array('data-icon'=>'edit')); ?>
		<?php endif ?>
		<?php if($this->Session->read('Auth.User.is_admin')) : ?>
			<li>&nbsp;</li>
			<li><?php echo $this->Html->link(__d('users', 'List Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'));?></li>
		<?php endif; ?>
			</ul>
		 </div><!-- navbar -->
		 <script>
			//<![CDATA[
			$(function(){
			  $( "div.ui-content" ).on( "swiperight", swiperightHandler );
				function swiperightHandler( event ){ 
					$.mobile.back();
				}
			});
			//]]>
			</script>
	</div><!-- /footer -->
</div><!-- /page -->