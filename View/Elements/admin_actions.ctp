	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?if (isset($creator)):?>
		<li><?php echo $this->Html->link(__('List Templates'),array(
			'admin'=>true,'plugin'=>'','controller'=>'templates','action'=>'index',$creator
		)); ?></li>
		<li><?php echo $this->Html->link(__('New Template'), array(
			'plugin'=>'','controller'=>'templates','action' => 'add',$creator
			)); ?></li>
		<?	if ($creator==Configure::read('globalSuperUser')):?>
		<li>admin buttons below:</li>
		<?if (isset($edit)) echo '<li>'.$this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Template.id'),$creator), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Template.id'))).
		'</li>'; ?>
		<li><?=$this->Html->link(__('List Users'), array('plugin'=>'users','controller' => 'users', 'action' => 'index')); ?> </li>		
		<li><?=$this->Html->link(__('List Comments'), array('plugin'=>'',
			'controller' => 'comments', 'action' => 'index',$creator)); ?> </li>
		<li><?=$this->Html->link(__('List Beacons'), array('plugin'=>'','controller' => 'beacons', 'action' => 'index')); ?> </li>
		<li><?=$this->Html->link(__('New Beacon'), array('plugin'=>'','controller' => 'beacons', 'action' => 'add')); ?> </li>
		<?
			endif;
		endif;
		?>
	</ul>