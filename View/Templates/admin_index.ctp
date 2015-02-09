
<div class="templates index">
<?

	if (empty($templates)){
		echo '
		<div style="border:3px solid green; padding:10px;">
			<h2>'.$creator.' has no templates. '.
			$this->Html->link('Click here to create one.', array(
			'plugin'=>'','controller'=>'templates','action' => 'add',$creator
			))
			.'<br /><br /><br /> To return to login '.
			$this->Html->link('click here', array(
			'plugin'=>'','controller'=>'templates','action' => 'login'
			))
			.'</h2>
		</div>
		
		';
	}
	else
	 echo '<h2>'.$creator.'\'s Templates </h2>';
?>
	
	<?php
		echo $this->Form->create('Template',
			array('url' => array_merge(array('action' => 'index'), $this->params['pass'])));
        echo $this->Form->input('searchdata', array('div' => false,'empty'=>true,'label'=>''));
        echo $this->Form->submit(__('Search', true), array('div' => false));
        echo $this->Form->end();
	?>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id','ID'); ?></th>
			<th><?php echo $this->Paginator->sort('location','Loc'); ?></th>
			<th><?php echo $this->Paginator->sort('meta_title','Title'); ?></th>
			<?if ($creator==Configure::read('globalSuperUser'))
			echo '<th>'. $this->Paginator->sort('creator').'</th>';?>
			<th><?php echo $this->Paginator->sort('name','Type'); ?></th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('nextid'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($templates as $template): ?>
	<tr>
		<td><?php echo h($template['Template']['id']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['location']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['meta_title']); ?>&nbsp;</td>
		<? if ($creator==Configure::read('globalSuperUser')) echo '<td>'.h($template['Template']['creator']).'&nbsp;</td>';?>
		<td><?php echo h($template['Template']['name']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['code']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['nextid']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['active']); ?>&nbsp;</td>
		<td><?php echo h($template['Template']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('admin'=>false,'action' => 'view', $template['Template']['id'])); ?>
			<?php echo $this->Html->link(__('Stats'), array('action' => 'view', $template['Template']['id'],$creator)); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $template['Template']['id'],$creator)); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $template['Template']['id']), array(), __('Are you sure you want to delete # %s?', $template['Template']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>

	
</div>
<div class="actions">
 <?=$this->element('admin_actions')?>
</div>