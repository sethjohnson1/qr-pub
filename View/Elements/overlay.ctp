<?
	if (isset($show)):
?>
<style>
	.rankpop{
		padding:20px;
		//margin-top:5%;
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
		margin: 0 auto;
		max-width:250px;
	}
	
	.discimg{
		width: 100%;
	}

</style>
<?
/*
the link below is clicked using JS further down to open the popup - this was the only thing that worked on iOS
using unique ID for clickOpen might be necessary if problems occur
*/
?>
<a id="clickOpen" href="#rankPopup<?=$template['Template']['id']?>" data-rel="popup" data-transition="pop"></a>

<div id="rankPopup<?=$template['Template']['id']?>" data-theme="a" data-overlay-theme="a" data-role="popup" data-position-to="window" class="rankpop">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
<?
if ($starrating<5):
?>
<div class="disccontainer">
<?=$this->Html->image('star_'.$starrating.'.png',array('class'=>'discimg'))?>
</div>
<h3>You've visited enough stops to earn an iScout Star!</h3>
<?else:?>
<h3>Great scouting!
You've earned our Top iScout Rank with all five stars
Take one last look at your Score Card, your postcards, and share your achievement!</h3>
<?endif?>

<h3 class="ui-mini">
Check your Score Card for your official title, some free advice, and the postcards you’ve unlocked!
</h3>
<?
		echo $this->Html->link('Check Score Card',array('plugin'=>'','controller'=>'templates','action'=>'scorecard'),array(
			'data-role'=>'button','data-theme'=>'h','rel'=>'external','class'=>'scorecard'
			));
			
		echo $this->Html->link('Not now',array('#'),array(
			'data-role'=>'button',
			'data-theme'=>'i',
			'data-rel'=>'back',
			'style'=>'opacity:.75'
			));
?>
</div><!-- rankPopup -->

<script type="text/javascript" language="JavaScript">

/* this method worked great on everything except iOS, where it only worked on Ajax loaded pages
(and since all the codes DO NOT use ajax, it was basically worthless on iOS.
Must be enabled for android to work though...
 */

/*	$(":jqmData(role='page'):last").on("pageshow", function(event) {
	  $("#rankPopup<?=$template['Template']['id']?>", $(this)).popup("open",{transition:"pop"});
	});	
*/

//this one worked a little better but would load popups on preloaded next page
/*	$("#qrpage<?=$template['Template']['id']?>").on("pageshow", function () {
		var popup = setInterval(function(){
			$("#rankPopup<?=$template['Template']['id']?>").popup("open");
			clearInterval(popup);
		},1);
	});
	*/
	//this hacky method of waiting and then clicking a link works on iOS and desktop NOT android!
	setTimeout(function(){$("#clickOpen").click()},1000);

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
else:
?>
<script>
$(":jqmData(role='page'):last").on("pageshow", function(event) {
	$("#rankPopup<?=$template['Template']['id']?>", $(this)).popup("destroy");
});

</script>
<?endif?>