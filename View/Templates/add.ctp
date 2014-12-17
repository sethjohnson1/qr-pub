<?
if (isset($edit)) $ae='Edit';
else $ae='Add';
?>
<div class="templates form">

<?php 

//debug($edit);
echo $this->Form->create('Template'); ?>
	<fieldset>
		<legend><?php echo __($ae.' Template'); ?></legend>
	<?php
		if (isset($edit)) echo $this->Form->input('id');
		echo $this->Form->input('name',array('type'=>'select','options'=>$templates,'label'=>'Template type'));
		//else echo $this->Form->input('name',array('type'=>'hidden'));
		echo $this->Form->input('location',array('type'=>'select','options'=>$locations));
		echo $this->Form->input('active',array('checked'=>'checked'));
		echo $this->Form->input('creator',array('label'=>'Creator. Name must match to link templates'));
		echo $this->Form->input('meta_title');
		echo $this->Form->input('meta_desc');
		echo $this->Form->input('nextid',array('label'=>'Next ID. Be sure that creator name matches!'));
		//echo $this->Form->input('previd',array('label'=>'you do not need to fill this in, here for testing'));
		echo $this->Form->input('code');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<? if (isset($edit)) echo '<li>'.$this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Template.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Template.id'))).
		'</li>'; ?>

		<li><?php echo $this->Html->link(__('List Templates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Assets'), array('controller' => 'assets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('controller' => 'assets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Beacons'), array('controller' => 'beacons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Beacon'), array('controller' => 'beacons', 'action' => 'add')); ?> </li>
	</ul>
</div>
