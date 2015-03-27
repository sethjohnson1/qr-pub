<?
//the key is the order that they appear
$menu=array();
$menu[100]['name']='Browse Stops';
$menu[100]['url']=array('plugin'=>'','controller'=>'templates','action'=>'browse');
if (Configure::read('enableKioskMode')!=1) {
	$menu[200]['name']='My Score Card';
	$menu[200]['url']=array('plugin'=>'','controller'=>'templates','action'=>'scorecard');
	$menu[201]['name']='My Postcards';
	$menu[201]['url']=array('plugin'=>'','controller'=>'templates','action'=>'postcard',$postcard_crypt);
}
$menu[300]['name']='Give Feedback';
$menu[300]['url']=array('plugin'=>'','controller'=>'templates','action'=>'feedback');
$menu[0]['name']='About iScout';
$menu[0]['url']=array('plugin'=>'','controller'=>'templates','action'=>'about');
ksort($menu);
?>

<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
<ul data-role="listview">
<?

//quickfix for Scorecard
$external=array();
foreach ($menu as $val){
	if ($val['name']=='My Score Card' || $val['name']=='My Postcards') $external=array('rel'=>'external','class'=>'scorecard');
	else $external='';
	
	echo '<li>'.$this->Html->link($val['name'],$val['url'],$external).'</li>';
}
//debug($menu);
	?>
	
	<li><a href="#" data-rel="close" class="ui-btn ui-corner-all ui-btn-a ui-icon-delete 
	ui-btn-icon-right ui-btn-inline">Close Panel</a>
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
