<div class="actions">
	<ul>
		<?php if (!$this->Session->read('Auth.User.id')) : ?>
			<li><?php echo $this->Html->link('Login', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login')); ?></li>
			<li><?php echo $this->Html->link('FBAuth', array('plugin' => 'users', 'controller' => 'users', 'action' => 'auth_login','Facebook')); ?></li>
			<li><?php echo $this->Html->link('GAuth', array('plugin' => 'users', 'controller' => 'users', 'action' => 'auth_login','Google'),array('rel'=>'external')); ?></li>
			<li><?php echo $this->Html->link('TLogin', array('plugin' => 'users', 'controller' => 'users', 'action' => 'tlogin')); ?></li>
			<li><?php echo $this->Html->link('Logout', array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?></li>
				<?php if (!empty($allowRegistration) && $allowRegistration) : ?>
			<li><?php echo $this->Html->link(('Register an account'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'add')); ?></li>
		<?php endif; ?>
		<?php else : ?>
			<li><?php echo $this->Html->link('Logout', array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?>
			<li><?php echo $this->Html->link('Change password', array('plugin' => 'users', 'controller' => 'users', 'action' => 'change_password')); ?>
		<?php endif ?>
		<?php if($this->Session->read('Auth.User.is_admin')) : ?>
			<li>&nbsp;</li>
			<li><?php echo $this->Html->link(__d('users', 'List Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'));?></li>
		<?php endif; ?>
	</ul>
</div>
