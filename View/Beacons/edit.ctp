<div class="beacons form">
<?php echo $this->Form->create('Beacon'); ?>
	<fieldset>
		<legend><?php echo __('Edit Beacon'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		echo $this->Form->input('uuid');
		echo $this->Form->input('major');
		echo $this->Form->input('minor');
		echo $this->Form->input('strength');
		echo $this->Form->input('museum');
		echo $this->Form->input('template_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Beacon.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Beacon.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Beacons'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
	</ul>
</div>
