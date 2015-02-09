<?
$avg=0;
foreach( $template['Comment'] as $comment){
	$avg=$comment['rating']+$avg;
}
$avg=round($avg/count( $template['Comment']),1);
?>
<div class="admin1 index">
<h2><?=$template['Template']['meta_title']?></h2>
<h2 style="color:green;">Comments: <?=count( $template['Comment'])?><br/>Avg Rating: <?=$avg?></h2>
	<h3>Comments</h3>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Rating</th>
			<th>Hidden</th>
			<th>User</th>
			<th>Comment</th>
		</tr>
	
	<? foreach($template['Comment'] as $key=>$value):?>
	<?//debug($value);?>
	<tr>

		<td><?=$value['rating']?></td>
		<td><?=$value['hidden']?></td>
		<td><?=$this->Html->link($value['User']['given_name'],array(
			'plugin'=>'users','controller'=>'users','action'=>'view',$value['User']['id']
		))?></td>
		<td style="max-width: 250px; overflow: auto;"><?=$this->Html->link($value['thoughts'], array(
		'plugin'=>'','controller'=>'comments','action' => 'edit', $value['id'])) ?>
		</td>
	</tr>
	<?endforeach?>
	</table>
</div>

<div class="actions">
 <?=$this->element('admin_actions')?>
</div>

