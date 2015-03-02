<div class="ranks index">
	<h2><?php echo __('Ranks'); ?></h2>
		<?php
		echo $this->Form->create('Rank',
			array('url' => array_merge(array('action' => 'index'), $this->params['pass'])));
        echo $this->Form->input('searchdata', array('div' => false,'empty'=>true,'label'=>''));
        echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end();
	?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('quote'); ?></th>
			<th><?php echo $this->Paginator->sort('ranktype'); ?></th>
			<th><?php echo $this->Paginator->sort('rankvalue'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ranks as $rank): ?>
	<tr>
		<td><?php echo h($rank['Rank']['id']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['created']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['name']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['quote']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['ranktype']); ?>&nbsp;</td>
		<td><?php echo h($rank['Rank']['rankvalue']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $rank['Rank']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $rank['Rank']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $rank['Rank']['id']), array(), __('Are you sure you want to delete # %s?', $rank['Rank']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rank'), array('action' => 'add')); ?></li>
	</ul>
</div>
