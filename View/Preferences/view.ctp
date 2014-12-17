<div class="preferences view">
<h2><?php echo __('Preference'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($preference['Preference']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($preference['Preference']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name Value'); ?></dt>
		<dd>
			<?php echo h($preference['Preference']['name_value']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Preference'), array('action' => 'edit', $preference['Preference']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Preference'), array('action' => 'delete', $preference['Preference']['id']), array(), __('Are you sure you want to delete # %s?', $preference['Preference']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Preferences'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Preference'), array('action' => 'add')); ?> </li>
	</ul>
</div>
