<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');

if(!isset($location)){
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
}


echo $this->element('jqm_basic_footer');
?>