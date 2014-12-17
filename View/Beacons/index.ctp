<div class="beacons index">
	<h2><?php echo __('Beacons'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('uuid'); ?></th>
			<th><?php echo $this->Paginator->sort('major'); ?></th>
			<th><?php echo $this->Paginator->sort('minor'); ?></th>
			<th><?php echo $this->Paginator->sort('strength'); ?></th>
			<th><?php echo $this->Paginator->sort('museum'); ?></th>
			<th><?php echo $this->Paginator->sort('template_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($beacons as $beacon): ?>
	<tr>
		<td><?php echo h($beacon['Beacon']['id']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['name']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['created']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['modified']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['active']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['uuid']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['major']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['minor']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['strength']); ?>&nbsp;</td>
		<td><?php echo h($beacon['Beacon']['museum']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($beacon['Template']['name'], array('controller' => 'templates', 'action' => 'view', $beacon['Template']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $beacon['Beacon']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $beacon['Beacon']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $beacon['Beacon']['id']), array(), __('Are you sure you want to delete # %s?', $beacon['Beacon']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Beacon'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
	</ul>
</div>
