<div class="commentsUsers form">
<?php echo $this->Form->create('CommentsUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Comments User'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('comment_id');
		echo $this->Form->input('rating');
		echo $this->Form->input('vote');
		echo $this->Form->input('flagged');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Comments Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
