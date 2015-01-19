<?
$menu=array();
$menu[0]['name']='Browse stops';
$menu[0]['url']=array('plugin'=>'','controller'=>'templates','action'=>'browse');
/*
$menu[1]['name']='ScoreCard';
$menu[1]['url']=array('plugin'=>'','controller'=>'templates','action'=>'feedback');
*/
$menu[2]['name']='Give Feedback';
$menu[2]['url']=array('plugin'=>'','controller'=>'templates','action'=>'feedback');
$menu[3]['name']='About iScout';
$menu[3]['url']=array('plugin'=>'','controller'=>'templates','action'=>'about');
//debug($menu);
?>

<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
<ul data-role="listview">
<?
foreach ($menu as $val){
	echo '<li>'.$this->Html->link($val['name'],$val['url']).'</li>';
}
//debug($menu);
	?>
	
	<li><a href="#" data-rel="close" class="ui-btn ui-corner-all ui-btn-a ui-icon-delete 
	ui-btn-icon-right ui-btn-inline">Close panel</a>
	</li>
	</ul>
</div>