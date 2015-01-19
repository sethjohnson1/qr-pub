<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');
/* the original way, I like the listview better
if(!isset($location)){
	echo $this->Html->link('Welcome Page','/',array(
			'data-role'=>'button'
	));
	foreach ($locations as $link=>$name){
		echo $this->Html->link($name,array('action'=>'browse',$link),array(
			'data-role'=>'button'
		));
	}
}
else {
	foreach ($stops as $stop){
		echo $this->Html->link($stop['Template']['meta_title'],array('action'=>'view',$stop['Template']['id']),array(
			'data-role'=>'button'
		));
	}
}*/

//and now begins a nice nested loop
foreach ($locations as $key=>$location):
?>

				<div data-role="collapsible-set" data-theme="a">
					<div data-role="collapsible">
						<h3><?=$location?></h3>
						<ul data-role="listview">
							<? foreach ($stops[$key] as $stop): ?>
							<li>
							<?=
							$this->Html->link($stop['Template']['meta_title'],array('action'=>'view',$stop['Template']['id']),array(
							))
							?>
							</li>
							<? endforeach ?>
						</ul>
					</div>
				</div>
<? endforeach ?>
<?
echo $this->element('jqm_basic_footer');
?>