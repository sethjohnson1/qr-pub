<div class="assets view">
<?
//debug($asset);
//this is a very quick example
echo $this->Html->image('uploads/'.$asset['Template']['id'].'_'.$asset['Asset']['id'].'.jpg', array());

?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Asset'), array('action' => 'edit', $asset['Asset']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Asset'), array('action' => 'delete', $asset['Asset']['id']), array(), __('Are you sure you want to delete # %s?', $asset['Asset']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Assets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Asset'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Templates'), array('controller' => 'templates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Template'), array('controller' => 'templates', 'action' => 'add')); ?> </li>
	</ul>
</div>
