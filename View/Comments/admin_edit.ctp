<div class="comments form">
<?php echo $this->Form->create('Comment'); ?>
	<fieldset>
		<legend><?php echo __('Edit Comment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('thoughts',array('disabled'=>true));
		//echo $this->Form->input('rating');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('hidden');
		echo $this->Form->input('responded');
		echo $this->Form->input('flags');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">

	 <?=$this->element('admin_actions')?>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Comment.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Comment.id'))); ?></li>

	</ul>
</div>
