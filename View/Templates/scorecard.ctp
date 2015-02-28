<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');
	//set colors, really should be done globally somewhere but onward.
	$bbm='#6e3219';
	$cfm='#004250';
	$dmnh='#035642';
	$wg='#981e32';
	$pim='#bd4f19';
	$hmrl='#532e60';
	$garden='#c59217';

	//grand totals, unset NW (Nowhere) for now
	$total=0;
	$score=0;
	foreach ($totals['totals'] as $val)	$total=$val+$total;
	foreach ($totals['counts'] as $val)	$score=$val+$score;
	
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


 </style>
 
 
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
		<div class="ui-grid-a score" style="">
			<div class="ui-block-a">
			<h3 class="ui-mini"><em>OVERALL</em></h3>
			<h1><?=$score.' / '.$total?></h1>
			</div>
			<div class="ui-block-b">
			<h1 align="center" class="reveal">Tap for Rank</h1>
			<div class="hidden_rank" style="display: none">
			<h1 align="center">
			<?
				$this->set(compact('total','score'));
				echo $this->element('rank',array($total,$score));
			?>
			<br />
			<?
			//now make the stars
			for ($x=0;$x<=4; $x++):
				if (($score/$total)/.2 > $x) $starred='starred';
				else $starred='';
				
			?>
			<span class="ui-icon-star ui-btn-icon-notext staricon <?=$starred ?>"/></span>

			<?
			endfor;
			?>
			
			</h1>
			<!-- p class="ui-mini">
			<em>
			Keep searching to discover your true self. Eventually these should be random quotes (or nothing! :-)
			</em>
			<p -->
			</div>
			<script>
				$( "h1.reveal" ).click(function() {
				  $( this ).slideUp("slow");
				  $( "div.hidden_rank" ).slideDown("slow");
				});
			</script>
			</div>
		</div>
		<div class="ui-grid-a score" style="color:<?=$bbm?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('bbm.png',array('alt'=>'Buffalo Bill Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['BBM'].' of '.$totals['totals']['BBM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$cfm?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('cfm.png',array('alt'=>'Cody Firearms Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['CFM'].' of '.$totals['totals']['CFM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$dmnh?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('dmnh.png',array('alt'=>'Draper Natural History Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['DMNH'].' of '.$totals['totals']['DMNH']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$pim?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('pim.png',array('alt'=>'Plains Indian Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['PIM'].' of '.$totals['totals']['PIM']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$wg?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('wg.png',array('alt'=>'Draper Natural History Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['WG'].' of '.$totals['totals']['WG']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$hmrl?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('hmrl.png',array('alt'=>'McCracken Research Library icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b">
			<h2 align="center"><?=$totals['counts']['HMRL'].' of '.$totals['totals']['HMRL']?></h2>
			</div>
		</div>
		
		<div class="ui-grid-a score" style="color:<?=$garden?>;">
			<div class="ui-block-a">
			<?=$this->Html->image('garden.png',array('alt'=>'Sculpture Garden icon','class'=>'logos'))?>
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