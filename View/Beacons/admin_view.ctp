<div class="beacons view">
<h2><?php echo __('Beacon'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Major'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['major']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Minor'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['minor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Strength'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['strength']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Museum'); ?></dt>
		<dd>
			<?php echo h($beacon['Beacon']['museum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Template'); ?></dt>
		<dd>
			<?php echo $this->Html->link($beacon['Template']['name'], array('controller' => 'templates', 'action' => 'view', $beacon['Template']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Beacon'), array('action' => 'edit', $beacon['Beacon']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Beacon'), array('action' => 'delete', $beacon['Beacon']['id']), array(), __('Are you sure you want to delete # %s?', $beacon['Beacon']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Beacons'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Beacon'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
	</ul>
</div>
