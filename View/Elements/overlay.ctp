<?

	
	//disabled just for testing
	//if (isset($show)):
	?>
<style>
	.rankpop{
		padding:20px;
		margin-top:5%;
	}
	
	.staricon{
		position: relative;
		padding: 12px;
	}
	.starred:after{
		background-color: #bd4f19 !important;
	}
	.starcontainer{
		margin:0 auto;
		width: 135px;
	}
	
	.disccontainer{
		max-height: 50%;
		margin: 0 auto;
	}
	
	.discimg{
		width: 100%;
	}

</style>
<div id="rankPopup<?=$template['Template']['id']?>" data-theme="a" data-overlay-theme="a" data-role="popup" data-history="false" data-position-to="window" class="rankpop">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
<?
$a='an';
if ($starrating<5):
if ($starrating>1) $a='another';
?>
<div class="disccontainer">
<?=$this->Html->image('star_'.$starrating.'.png',array('class'=>'discimg'))?>
</div>
<h1>Good job!</h1>
<h3>You've visited enough stops to earn <?=$a?> iScout Star.</h3>
<?else:?>
<h1>Great work!</h1>
<h3>You've earned the distinguished five-star iScout Rank.</h3>
<?endif?>
<div class="starcontainer">
<?
	for ($x=0;$x<=4; $x++):
		if ($starrating > $x) $starred='starred';
		else $starred='';
	
?>

<span class="ui-icon-star ui-btn-icon-notext staricon <?=$starred ?>"/></span>
<?endfor?>
</div><!-- starcontainer -->
<h3>Check your Score Card to see your Official iScout Title, receive some free advice, and view unlocked Postcards.</h3>
<?
		echo $this->Html->link('Check Score Card',array('plugin'=>'','controller'=>'templates','action'=>'scorecard'),array(
			'data-role'=>'button','data-theme'=>'h','rel'=>'external','class'=>'scorecard'
			));
			
		echo $this->Html->link('Not now',array('#'),array(
			'data-role'=>'button',
			'data-theme'=>'i',
			'data-rel'=>'back'
			));
?>
</div><!-- rankPopup -->

<script type="text/javascript" language="JavaScript">


	$(":jqmData(role='page'):last").on("pageshow", function(event) {
	  $("#rankPopup<?=$template['Template']['id']?>", $(this)).popup("open",{transition:"pop"});
	});	

	
	$( ".scorecard" ).click(function() {
			$.mobile.loading( 'show', {
				text: 'Tallying ...',
				textVisible: true,
				theme: 'a',
				html: ""
			}); 
	});
</script>

<?
//finally, if we're here and NOT popping up, then destroy any that might be around (for example they returned to a page where it popped up
/*else:
?>
<script>
$(":jqmData(role='page'):last").on("pageshow", function(event) {
	$("#rankPopup<?=$template['Template']['id']?>", $(this)).popup("destroy");
});
</script>
<?endif*/?>