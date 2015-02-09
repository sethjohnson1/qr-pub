<?php
/**
 * Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2014, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="users index">
	<h2><?php echo __d('users', 'Users'); ?></h2>

	<?php
	/* sj commented out
	if (CakePlugin::loaded('Search')) {
			echo '<h3>' . __d('users', 'Filter') . '</h3>';
			echo $this->Form->create($model, array('action' => 'index'));
				echo $this->Form->input('username', array('label' => __d('users', 'Username')));
				echo $this->Form->input('email', array('label' => __d('users', 'Email')));
			echo $this->Form->end(__d('users', 'Search'));
		}
		*/
	//debug($users);
	?>
	
	<?php echo $this->element('Users.paging'); ?>
	<?php echo $this->element('Users.pagination'); ?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('given_name','name'); ?></th>
			<th><?php echo $this->Paginator->sort('provider'); ?></th>
			<th><?php echo $this->Paginator->sort('engaged'); ?></th>
			<th><?php echo $this->Paginator->sort('comment_count','Comments'); ?></th>
			<th><?php echo $this->Paginator->sort('upvotes'); ?></th>
			<th><?php echo $this->Paginator->sort('downvotes'); ?></th>
			<th><?php echo $this->Paginator->sort('flags'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
		</tr>
			<?php
			$i = 0;
			foreach ($users as $user):
				$class = null;
				if ($i++ % 2 == 0) :
					$class = ' class="altrow"';
				endif;
			?>
			<tr<?php echo $class;?>>
				<td>
					<?= $this->Html->link($user[$model]['given_name'].' '.$user[$model]['family_name'],array('action'=>'view',$user[$model]['id'])) ?>
				</td>
				<td><?=$user[$model]['provider']?></td>
				<td><?=$user[$model]['engaged']?></td>
				<td><?=$user[$model]['comment_count']?></td>
				<td><?=$user[$model]['upvotes']?></td>
				<td><?=$user[$model]['downvotes']?></td>
				<td><?=$user[$model]['flags']?></td>
				<td>
					<?php echo $user[$model]['created']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Users.pagination'); ?>
</div>
<div class="actions">
<?=$this->element('admin_actions')?>
</div>
