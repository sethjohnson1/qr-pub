<?
//first give them a 0 to 5 score
$starrating=round(($score/$total)/.2);
//debug($dbranks);
$ranks=array();

//construct DB info into easy array where 0-5 key corresponded with the star value
foreach($dbranks as $key=>$rank){
	$rankkey=$rank['Rank']['rankvalue'];
	if (!isset($ranks[$rankkey]['prefixes'])) $ranks[$rankkey]['prefixes']=array();
	if (!isset($ranks[$rankkey]['titles'])) $ranks[$rankkey]['titles']=array();
	if (!isset($ranks[$rankkey]['quotes'])) $ranks[$rankkey]['quotes']=array();

	if ($rank['Rank']['ranktype']=='prefix') array_push($ranks[$rankkey]['prefixes'],$rank['Rank']['name']);
	if ($rank['Rank']['ranktype']=='title') array_push($ranks[$rankkey]['titles'],$rank['Rank']['name']);
	if ($rank['Rank']['ranktype']=='quote'){ 
		$quote=array('text'=>$rank['Rank']['quote'],'by'=>$rank['Rank']['name']);
		array_push($ranks[$rankkey]['quotes'],$quote);
	}
}
	//debug($ranks);
	$yourrank=$ranks[$starrating]['prefixes'][rand(
	0,count($ranks[$starrating]['prefixes'])-1)].' '.$ranks[$starrating]['titles'][rand(0,count($ranks[$starrating]['titles'])-1)];
	$yourquote=$ranks[$starrating]['quotes'][rand(0,count($ranks[$starrating]['quotes'])-1)];

?>


<h1 align="center">
<?
	echo $yourrank;
?>
<br />
<?
//now draw the stars
for ($x=0;$x<=4; $x++):
	if ($starrating > $x) $starred='starred';
	else $starred='';
	
?>
<span class="ui-icon-star ui-btn-icon-notext staricon <?=$starred ?>"/></span>

<?
endfor;
?>
			
</h1>
<p align="center" class="ui-mini"><em><?=$yourquote['text']?></em> - <?=$yourquote['by']?></p>

<script>
	$( "h1.reveal" ).click(function() {
	  $( this ).slideUp();
	  $( "div.hidden_rank" ).slideDown("slow");
	});
</script>