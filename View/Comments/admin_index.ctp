<?
//debug($comments);
?>
<div class="comments index">
	<h2><?php echo __('Comments'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>

			<th><?php echo $this->Paginator->sort('template_id'); ?></th>
			<th><?php echo $this->Paginator->sort('thoughts'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('hidden'); ?></th>
			<th><?php echo $this->Paginator->sort('responded'); ?></th>
			<th><?php echo $this->Paginator->sort('flags'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($comments as $comment): ?>
	<tr>
		<td><?=$this->Html->link($comment['Template']['meta_title'],array('controller'=>'templates','action'=>'view',$comment['Template']['id'])); ?>&nbsp;</td>
		<td style="max-width:300px; overflow:auto;"><?php echo h($comment['Comment']['thoughts']); ?>&nbsp;</td>
		<td><?php echo h($comment['Comment']['rating']); ?>&nbsp;</td>
		<td><?php echo h($comment['Comment']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comment['User']['given_name'], array('plugin'=>'users','controller' => 'users', 'action' => 'view', $comment['User']['id'])); ?>
		</td>
		<td><?php echo h($comment['Comment']['hidden']); ?>&nbsp;</td>
		<td><?php echo h($comment['Comment']['responded']); ?>&nbsp;</td>
		<td><?php echo h($comment['Comment']['flags']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $comment['Comment']['id'])); ?>
			<?=$this->Html->link(__('Edit'), array('action' => 'edit', $comment['Comment']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comment['Comment']['id']), array(), __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?>
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
 <?=$this->element('admin_actions')?>
</div>
