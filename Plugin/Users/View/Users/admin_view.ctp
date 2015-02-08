<?
//first loop through to make averages, just the rating for now but eventually votes
$avgrating=0;
foreach($user['Comment'] as $comment){
	$avgrating=$comment['rating']+$avgrating;
}
$avgrating=$avgrating/count($user['Comment']);
//debug($avgrating);
?>
<div class="users form">
<?
 echo $this->Form->create();
 echo $this->Form->input('id',array('value'=>$user['User']['id']));
 echo $this->Form->input('engaged',array('checked'=>$user['User']['engaged']));
 echo $this->Form->end('Save');
?>
	
	
	<h2><?=$user[$model]['username'].' via '.$user[$model]['provider']?></h2>
	
	<ul>
		<li>Created: <?=$user[$model]['created'] ?></li>
		<? //make this a link eventually ?>
		<li>OID: <?=$this->Html->link($user[$model]['oid'],$user[$model]['oid']) ?></li>
		<li>Full name: <?=$user[$model]['given_name'].' '.$user[$model]['family_name'] ?></li>
		<li>Gender: <?=$user[$model]['gender']?></li>
		<li>Email: <?=$user[$model]['email']?></li>
		<li>Avg. Rating: <?=$avgrating?></li>
	</ul>
	<br />
	<h3>Comments</h3>
	<ul>
	<? foreach($user['Comment'] as $key=>$value):?>
	<li>
		<?
		echo $this->Html->link($value['Template']['code'].' - '.$value['Template']['meta_title'],array('admin'=>false,'plugin'=>'',
			'controller'=>'templates',
			'action'=>'view',$value['template_id']
			)).' - <strong>Rating:</strong> '.$value['rating'].'<strong> // </strong> '. 
		$value['thoughts'];
		?>
	</li>
	<?endforeach?>
	</ul>
	<?debug($user);?>
</div>
<div class="actions">
<?=$this->element('admin_actions')?>

</div>

	
