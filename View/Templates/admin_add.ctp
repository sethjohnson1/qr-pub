<?
if (isset($edit)) $ae='Edit';
else $ae='Add';
?>
<div class="templates form">

<?php 

//debug($edit);
echo $this->Form->create('Template',
	array('data-ajax'=>'false')

); ?>
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
		//currently, forms must be saved, then edited to link together
		if (isset($edit)) echo $this->Form->input('nextid',array('label'=>'Next ID. Be sure that creator name matches!'));
		//previd gets filled in automatically
		if (isset($edit)) echo $this->Form->input('previd',array('label'=>'Prev ID. Only needed if something has gone wrong with linking.'));
		echo $this->Form->input('code',array('label'=>'Navigation Code. This is only here for the Whitney and will be hidden soon'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
<?=$this->element('admin_actions')?>

</div>
