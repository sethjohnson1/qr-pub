<? 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');

 ?>
 
 <style type="text/css" scoped>
	.logos{
		max-width:100%;
		padding: 0 5px 0 0;
		float: left;
	}
	.myicons{
		padding: 0 5px 0 0;
		border: 1px;
		border-style: none solid none solid;
	}
	.mycounters{
		//padding-top:2.5%;
	}
 </style>
 
 
		<div class="ui-body ui-body-a ui-corner-all ui-shadow">
		<h3>Score Card</h3>
		<?debug($totals)?>
		<div class="ui-grid-a">
			<div class="ui-block-a myicons " style="color:#6E3219;">
			<?=$this->Html->image('bbm.png',array('alt'=>'Buffalo Bill Museum icon','class'=>'logos'))?>
			</div>			
			<div class="ui-block-b myicons" style="color:#054552">
				<?=$this->Html->image('cfm.png',array('alt'=>'Cody Firearms Museum icon','class'=>'logos'))?>
			</div>						
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a mycounters">
			<? echo $totals['counts']['BBM'].'/'.$totals['totals']['BBM']; ?>
			</div>			
			<div class="ui-block-b mycounters">
			<? echo $totals['counts']['CFM'].'/'.$totals['totals']['CFM']; ?>
			</div>			
		</div>
		<hr />		
		<div class="ui-grid-a">
			<div class="ui-block-a myicons" style="color:#035642">
			<?=$this->Html->image('dmnh.png',array('alt'=>'Draper Natural History Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b myicons" style="color:#532E60">
			<?=$this->Html->image('gardens.png',array('alt'=>'Outdoor Gardens icon','class'=>'logos'))?>
			</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a mycounters">
			<? echo $totals['counts']['DMNH'].'/'.$totals['totals']['DMNH']; ?>
			</div>			
			<div class="ui-block-b mycounters">
			<? echo $totals['counts']['Garden'].'/'.$totals['totals']['Garden']; ?>
			</div>			
		</div>
		<hr />		
		<div class="ui-grid-a">
			<div class="ui-block-a myicons" style="color:#C35118">
			<?=$this->Html->image('mrl.png',array('alt'=>'McCracken Research Library icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b myicons" style="color:#981E32">
			<?=$this->Html->image('pim.png',array('alt'=>'Plains Indian Museum icon','class'=>'logos'))?>
			</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a mycounters">
			<? echo $totals['counts']['HMRL'].'/'.$totals['totals']['HMRL']; ?>
			</div>			
			<div class="ui-block-b mycounters">
			<? echo $totals['counts']['PIM'].'/'.$totals['totals']['PIM']; ?>
			</div>			
		</div>
		<hr />
		<div class="ui-grid-a">
			<div class="ui-block-a myicons" style="color:#C35118">
			<?=$this->Html->image('wg.png',array('alt'=>'Whitney Western Art Museum icon','class'=>'logos'))?>
			</div>
			<div class="ui-block-b myicons" style="color:#981E32">
				
			</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a mycounters">
			<? echo $totals['counts']['WG'].'/'.$totals['totals']['WG']; ?>
			</div>			
			<div class="ui-block-b mycounters">
			
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