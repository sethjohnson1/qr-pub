<? 
echo $this->element('jqm_header');

	//grand totals, unset NW (Nowhere) for now
	$total=0;
	$score=0;
	foreach ($totals['totals'] as $val)	$total=$val+$total;
	foreach ($totals['counts'] as $val)	$score=$val+$score;
	$starrating=round(($score/$total)/.2);
	
?>
 
 <style type="text/css" scoped>
	.logos{
		max-width:100%;
		padding: 0 5px 0 0;
		float: left;
	}
	
	.score{
		padding: 25px 5px 10px 0;
		border: 3px;
		border-style: none  none dotted none;
	}
	.starred:after{
		background-color: #bd4f19 !important;
	}
	.staricon{
		position: relative;
		padding: 12px;
	}
	.reveal{
		cursor: pointer;
	}
	
	.icon_container{
		width:65%;
	}
	
	.glowtron {
		-webkit-transition: text-shadow	.5s linear;
		-moz-transition: text-shadow	.5s linear;
		-ms-transition: text-shadow		.5s linear;
		-o-transition: text-shadow		.5s	linear;
		transition: text-shadow 1s	linear;
		//-webkit-text-stroke: 1px;
	}
	.glowtron.glow {
		text-shadow: 0 0 24px <?=$dmnh?>;
		
	}
	.glowtron.glow2 {
		text-shadow: 0 0 40px <?=$wg?>;
	}
	.badgecontainer{
		padding:10px;
	}
	
	.badgeimg{
		width:100%;
	}
	.badgepopup{
		padding: 20px;
		max-width:400px;
	}
	

}

 </style>
 
 <script>
 $( document ).on( "pageinit", function( event ) {
	 setInterval(function(){$('.glowtron').addClass('glow')}, 5);
	 setInterval(function(){$('.glowtron').addClass('glow2')}, 50);
	setInterval(function(){$('.glowtron').removeClass('glow')}, 200);
	setInterval(function(){$('.glowtron').removeClass('glow2')}, 400);
});
 </script>
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
		<div class="ui-grid-a score" style="">
			<div class="ui-block-a">
			<h3 class="ui-mini"><em>OVERALL</em></h3>
			<h1><?=$score.' / '.$total?></h1>
			</div>
		<div class="ui-block-b">
			<div class="glowtron">
			<h1 align="center" class="reveal">Tap for Rank</h1>
			</div>
			<div class="hidden_rank" style="display: none" >
			<?	
				$this->set(compact('starrating'));
				echo $this->element('rank',array($starrating));
			?>
			</div>
		</div>
		</div>
		<?
		//for testing
		//$starrating=3;
		?>
		<div class="ui-grid-d score">
			<?
			//for the ui-grid
			$letters=array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e');
			for ($x=1;$x<=5;$x++):
				if ($starrating >= $x){
					$badge='star_'.$x.'.png';
					$showtext=$x;
				}
				else {
					$badge='star_0.png';
					$showtext=0;
				}
				?>
			<div class="ui-block-<?=$letters[$x]?>">
				<div class="badgecontainer">
				<?=
				$this->Html->link(
				$this->Html->image($badge,array('class'=>'badgeimg')),'#badgePopup'.$x,array(
				'escape'=>false,
				'data-rel'=>'popup',
				'data-transition'=>'pop'))
				
				?>
				
				<div id="badgePopup<?=$x?>" data-theme="a" data-overlay-theme="a" data-role="popup" data-position-to="window" class="badgepopup">
				<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
				<?=$this->Html->image($badge,array('class'=>'badgeimg'))?>
				<?
				//show the rank for fun (why not?!)
				echo $this->element('rank',array('starrating'=>$showtext,'small'=>1));
				?>
				<?=$this->Html->link('I\'m Honored',array('#'),array(
					'data-role'=>'button',
					'data-theme'=>'e',
					'data-rel'=>'back',
					//'style'=>'opacity:.75'
			))?>
				</div>

				</div>
			</div>
			<?endfor?>
		</div><!-- ui-grid-d -->
		<div class="ui-grid-a score" style="color:<?=$bbm?>;">
			<div class="ui-block-a">
			<? // the width for each one is calculated by widest image (draper at 282px) divided by width (if less than 53% just use that). There is probably a better way, moving on for now  ?>
				<div style="width:65%"><?=$this->Html->image('bbm.png',array('alt'=>'Buffalo Bill Museum icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
				<h2 align="center"><?=$totals['counts']['BBM'].' of '.$totals['totals']['BBM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$cfm?>;">
			<div class="ui-block-a">
			<div style="width:81%"><?=$this->Html->image('cfm.png',array('alt'=>'Cody Firearms Museum icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['CFM'].' of '.$totals['totals']['CFM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$dmnh?>;">
			<div class="ui-block-a">
			<div style="width:100%"><?=$this->Html->image('dmnh.png',array('alt'=>'Draper Natural History Museum icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['DMNH'].' of '.$totals['totals']['DMNH']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$pim?>;">
			<div class="ui-block-a">
			<div style="width:63%"><?=$this->Html->image('pim.png',array('alt'=>'Plains Indian Museum icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['PIM'].' of '.$totals['totals']['PIM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$wg?>;">
			<div class="ui-block-a">
			<div style="width:87%"><?=$this->Html->image('wg.png',array('alt'=>'Whitney Western Art Museum icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['WG'].' of '.$totals['totals']['WG']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$hmrl?>;">
			<div class="ui-block-a">
			<div style="width:83%"><?=$this->Html->image('hmrl.png',array('alt'=>'McCracken Research Library icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['HMRL'].' of '.$totals['totals']['HMRL']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$garden?>;">
			<div class="ui-block-a">
			<div style="width:53%"><?=$this->Html->image('garden.png',array('alt'=>'Sculpture Garden icon','class'=>'logos'))?></div>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['Garden'].' of '.$totals['totals']['Garden']?></h2>
			</div>
		</div>
		
	<div style="padding:10px 20px;">
		<div class="ui-grid-solo">
		<? 
		echo $this->Form->postLink(('Clear Scorecard'), array('controller'=>'templates','action'=>'clear_card')
		, array('class'=>'ui-btn ui-btn-icon-left ui-icon-delete','rel'=>'external'), ('Are you sure you want to clear your card?'));

		?>
			</div>
	</div>
</div>
<?
echo $this->element('jqm_basic_footer');
?>