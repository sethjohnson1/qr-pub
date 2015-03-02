<div class="ranks form">
<?php echo $this->Form->create('Rank'); ?>
	<fieldset>
	<?
	if ($edit) $add='Edit';
	else $add='Add';
	?>
		<legend><?php echo __($add.' Rank'); ?></legend>
	<?php
		if($edit) echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('quote');
		echo $this->Form->input('ranktype',array('type'=>'select','options'=>array('prefix'=>'prefix','title'=>'title','quote'=>'quote')));
		echo $this->Form->input('rankvalue',array('type'=>'select','options'=>array(0,1,2,3,4,5)));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ranks'), array('action' => 'index')); ?></li>
	</ul>
</div>
