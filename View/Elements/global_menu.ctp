<?
$menu=array();
$menu[0]['name']='Browse stops';
$menu[0]['url']=array('plugin'=>'','controller'=>'templates','action'=>'browse');
if (Configure::read('enableKioskMode')!=1) {
	$menu[1]['name']='Score Card';
	$menu[1]['url']=array('plugin'=>'','controller'=>'templates','action'=>'scorecard');
}
$menu[2]['name']='Give Feedback';
$menu[2]['url']=array('plugin'=>'','controller'=>'templates','action'=>'feedback');
$menu[3]['name']='About iScout';
$menu[3]['url']=array('plugin'=>'','controller'=>'templates','action'=>'about');
?>

<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
<ul data-role="listview">
<?
//quickfix for Scorecard
$external=array();
foreach ($menu as $val){
	if ($val['name']=='Score Card') $external['data-rel']='external';
	
	echo '<li>'.$this->Html->link($val['name'],$val['url'],$external).'</li>';
}
//debug($menu);
	?>
	
	<li><a href="#" data-rel="close" class="ui-btn ui-corner-all ui-btn-a ui-icon-delete 
	ui-btn-icon-right ui-btn-inline">Close panel</a>
	</li>
	</ul>
</div>