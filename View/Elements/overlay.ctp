<style>
	.staricon{
		position: relative;
		padding: 12px;
	}
</style>
<?
	//grand totals, unset NW (Nowhere) for now
	$total=0;
	$score=0;
	foreach ($totals['totals'] as $val)	$total=$val+$total;
	foreach ($totals['counts'] as $val)	$score=$val+$score;
	
	//now 0 to 5 score
	$starrating=round(($score/$total)/.2);
echo '<div>';	
	//now draw the stars
	for ($x=0;$x<=4; $x++):
		if ($starrating > $x) $starred='starred';
		else $starred='';
	
?>

<span class="ui-icon-star ui-btn-icon-notext staricon <?=$starred ?>"/></span>
<?endfor?>
</div>
	//debug($total.' '.$score);
/* for getting percents
foreach ($totals['counts'] as $key=>$val){
		$percents[$key]=$val/$totals['totals'][$key];
	}
*/