<?
/*
begin zany ranking as proof of concept

create an array of ranks, the first key will be the percentage threshold
*/

$ranks=array(
	10=>array(
		'prefixes'=>array('Junior','Novice','Beginner'),
		'titles'=>array('Dabbler','Browser')
	),
	25=>array(
		'prefixes'=>array('Well-rounded','Versatile','Burgeoning'),
		'titles'=>array('Sightseer','Tourist')
	),
	50=>array(
		'prefixes'=>array('Experienced','Competent','Adept'),
		'titles'=>array('Explorer','Browser')
	),
	75=>array(
		'prefixes'=>array('Disciplined','Accomplished','Exemplary'),
		'titles'=>array('Searcher','Adventurer')
	),
	100=>array(
		'prefixes'=>array('Reverend','Honorable','Grand Master'),
		'titles'=>array('Curator','Scout')
	),
	//need an empty array greater than 100 for logic below to work
	101=>array()
);


//$rank='Nothing';
$prevkey='';
foreach ($ranks as $key=>$rank){
	if (!empty($prevkey)){
		if (($score/$total)*100<$key){
			$yourrank=$ranks[$prevkey]['prefixes'][rand(0,count($ranks[$prevkey]['prefixes'])-1)].' '.$ranks[$prevkey]['titles'][rand(0,count($ranks[$prevkey]['titles'])-1)];
			break;
		}
	}
	$prevkey=$key;
}

//so the final thing to do is simply echo the rank, similar to a function returning it
echo $yourrank;

?>