<?
$menu=array();
$menu[0]['name']='Browse stops';
$menu[0]['url']=array('plugin'=>'','controller'=>'templates','action'=>'browse');
if (Configure::read('enableKioskMode')!=1) {
	$menu[100]['name']='Score Card';
	$menu[100]['url']=array('plugin'=>'','controller'=>'templates','action'=>'scorecard');
	$menu[101]['name']='My Postcards';
	$menu[101]['url']=array('plugin'=>'','controller'=>'templates','action'=>'postcard',$postcard_crypt);
}
$menu[200]['name']='Give Feedback';
$menu[200]['url']=array('plugin'=>'','controller'=>'templates','action'=>'feedback');
$menu[300]['name']='About iScout';
$menu[300]['url']=array('plugin'=>'','controller'=>'templates','action'=>'about');
?>

<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
<ul data-role="listview">
<?
//quickfix for Scorecard
$external=array();
foreach ($menu as $val){
	if ($val['name']=='Score Card') $external=array('rel'=>'external','class'=>'scorecard');
	
	echo '<li>'.$this->Html->link($val['name'],$val['url'],$external).'</li>';
}
//debug($menu);
	?>
	
	<li><a href="#" data-rel="close" class="ui-btn ui-corner-all ui-btn-a ui-icon-delete 
	ui-btn-icon-right ui-btn-inline">Close panel</a>
	</li>
	</ul>
</div>
<?//script below adds loader for score card click ?>
<script>
$( ".scorecard" ).click(function() {
			$.mobile.loading( 'show', {
				text: 'Tallying ...',
				textVisible: true,
				theme: 'a',
				html: ""
			}); 
			});
</script>
