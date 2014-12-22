<div class="commentsUsers view">
<h2><?php echo __('Comments User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($commentsUser['User']['name'], array('controller' => 'users', 'action' => 'view', $commentsUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo $this->Html->link($commentsUser['Comment']['thoughts'], array('controller' => 'comments', 'action' => 'view', $commentsUser['Comment']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vote'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['vote']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flagged'); ?></dt>
		<dd>
			<?php echo h($commentsUser['CommentsUser']['flagged']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comments User'), array('action' => 'edit', $commentsUser['CommentsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comments User'), array('action' => 'delete', $commentsUser['CommentsUser']['id']), array(), __('Are you sure you want to delete # %s?', $commentsUser['CommentsUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comments User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
