<div class="preferences form">
<?php echo $this->Form->create('Preference'); ?>
	<fieldset>
		<legend><?php echo __('Add Preference'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('name_value');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Preferences'), array('action' => 'index')); ?></li>
	</ul>
</div>
