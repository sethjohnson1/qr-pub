<div class="commentsUsers index">
	<h2><?php echo __('Comments Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th><?php echo $this->Paginator->sort('vote'); ?></th>
			<th><?php echo $this->Paginator->sort('flagged'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($commentsUsers as $commentsUser): ?>
	<tr>
		<td><?php echo h($commentsUser['CommentsUser']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($commentsUser['User']['name'], array('controller' => 'users', 'action' => 'view', $commentsUser['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($commentsUser['Comment']['thoughts'], array('controller' => 'comments', 'action' => 'view', $commentsUser['Comment']['id'])); ?>
		</td>
		<td><?php echo h($commentsUser['CommentsUser']['created']); ?>&nbsp;</td>
		<td><?php echo h($commentsUser['CommentsUser']['modified']); ?>&nbsp;</td>
		<td><?php echo h($commentsUser['CommentsUser']['rating']); ?>&nbsp;</td>
		<td><?php echo h($commentsUser['CommentsUser']['vote']); ?>&nbsp;</td>
		<td><?php echo h($commentsUser['CommentsUser']['flagged']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $commentsUser['CommentsUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $commentsUser['CommentsUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $commentsUser['CommentsUser']['id']), array(), __('Are you sure you want to delete # %s?', $commentsUser['CommentsUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Comments User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
