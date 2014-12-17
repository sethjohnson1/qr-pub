<div class="actions">
	<ul>
		<?php if (!$this->Session->read('Auth.User.id')) : ?>
			<li><?php echo $this->Html->link(__d('users', 'Login'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'login')); ?></li>
			<li><?php echo $this->Html->link(__d('users', 'GLogin'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'glogin')); ?></li>
			<li><?php echo $this->Html->link(__d('users', 'FBAuth'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'auth_login','Facebook')); ?></li>
			<li><?php echo $this->Html->link(__d('users', 'GAuth'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'auth_login','Google')); ?></li>
			<li><?php echo $this->Html->link(__d('users', 'TLogin'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'tlogin')); ?></li>
			<li><?php echo $this->Html->link(__d('users', 'Logout'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?></li>
				<?php if (!empty($allowRegistration) && $allowRegistration) : ?>
			<li><?php echo $this->Html->link(__d('users', 'Register an account'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'add')); ?></li>
		<?php endif; ?>
		<?php else : ?>
			<li><?php echo $this->Html->link(__d('users', 'Logout'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout')); ?>
			<li><?php echo $this->Html->link(__d('users', 'My Account'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'edit')); ?>
			<li><?php echo $this->Html->link(__d('users', 'Change password'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'change_password')); ?>
		<?php endif ?>
		<?php if($this->Session->read('Auth.User.is_admin')) : ?>
			<li>&nbsp;</li>
			<li><?php echo $this->Html->link(__d('users', 'List Users'), array('plugin' => 'users', 'controller' => 'users', 'action' => 'index'));?></li>
		<?php endif; ?>
	</ul>
</div>
