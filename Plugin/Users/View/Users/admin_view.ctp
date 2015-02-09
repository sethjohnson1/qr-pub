<?
//first loop through and make some stats someday this could be on the DB itself 
$avgrating=0;
$flags=0;
foreach($user['Comment'] as $comment){
	$avgrating=$comment['rating']+$avgrating;
}
$avgrating=$avgrating/count($user['Comment']);
?>
<div class="users form">
<?
 echo $this->Form->create();
 echo $this->Form->input('id',array('value'=>$user['User']['id']));
 echo $this->Form->input('engaged',array('label'=>'Contacted / Creepily watched','checked'=>$user['User']['engaged']));
 echo $this->Form->end('Save');
?>
	
	
	<h2><?=$user[$model]['given_name'].' via '.$user[$model]['provider']?></h2>
	
	<ul>
		<li>Created: <?=$user[$model]['created'] ?></li>
		<? if ($user[$model]['provider']!='email'):?>
			<li>OID: <?=$this->Html->link($user[$model]['oid'],$user[$model]['oid'],array('target'=>'_blank')) ?></li>
		<?endif?>
		<li>Full name: <?=$user[$model]['given_name'].' '.$user[$model]['family_name'] ?></li>
		<li>Gender: <?=$user[$model]['gender']?></li>
		<li>Email: <?=$user[$model]['email']?></li>
		<li>Avg. Rating: <?=$avgrating?></li>
		<li>Upvotes: <?=$user['User']['upvotes']?></li>
		<li>Downvotes: <?=$user['User']['downvotes']?></li>
		<li>Flags: <?=$user['User']['flags']?></li>
	</ul>
	<br />
	<h3>Comments</h3>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Template</th>
			<th>Rating</th>
			<th>Hidden</th>
			<th>Comment</th>
		</tr>
	
	<? foreach($user['Comment'] as $key=>$value):?>
	<tr>
		<td><?=$this->Html->link($value['Template']['code'].' - '.$value['Template']['meta_title'],array('admin'=>false,'plugin'=>'',
			'controller'=>'templates',
			'action'=>'view',$value['template_id']
			))?>
		</td>
		<td><?=$value['rating']?></td>
		<td><?=$value['hidden']?></td>
		<td><?=$this->Html->link($value['thoughts'], array(
		'plugin'=>'','controller'=>'comments','action' => 'edit', $value['id'])) ?>
		</td>
	</tr>
	<?endforeach?>
	</table>
	<?//debug($user);?>
</div>
<div class="actions">
<?=$this->element('admin_actions')?>

</div>

	
