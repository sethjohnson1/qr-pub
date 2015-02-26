<div id="Scorecard" data-theme="a">
<?// debug($totals);?>
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		<h3>Score Card</h3>
		<div class="ui-grid-a">
			<div class="ui-block-a myicons" style="color:#6E3219;">a</div>		
			<div class="ui-block-b" id="myicons" style="color:#054552">b</div>						
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">
			<? echo $totals['counts']['BBM'].'/'.$totals['totals']['BBM']; ?>
			</div>			
			<div class="ui-block-b" id="mycounters">
			<? echo $totals['counts']['CFM'].'/'.$totals['totals']['CFM']; ?>
			</div>			
		</div>
		<hr>		
		<div class="ui-grid-a">
			<div class="ui-block-a" id="myicons" style="color:#035642">c</div>
			<div class="ui-block-b" id="myicons" style="color:#532E60">d</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">
			<? echo $totals['counts']['DMNH'].'/'.$totals['totals']['DMNH']; ?>
			</div>			
			<div class="ui-block-b" id="mycounters">
			<? echo $totals['counts']['HMRL'].'/'.$totals['totals']['HMRL']; ?>
			</div>			
		</div>
		<hr>		
		<div class="ui-grid-a">
			<div class="ui-block-a" id="myicons" style="color:#C35118">e</div>
			<div class="ui-block-b" id="myicons" style="color:#981E32">f</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">
			<? echo $totals['counts']['PIM'].'/'.$totals['totals']['PIM']; ?>
			</div>			
			<div class="ui-block-b" id="mycounters">
			<? echo $totals['counts']['WG'].'/'.$totals['totals']['WG']; ?>
			</div>			
		</div>
		
	<div style="padding:10px 20px;">
		<div class="ui-grid-solo">
		<? 
		echo $this->Form->postLink(('Clear Scorecard'), array('controller'=>'templates','action'=>'clear_card')
		, array('class'=>'ui-btn ui-btn-icon-left ui-icon-delete','rel'=>'external'), ('Are you sure you want to clear your card?'));

		
		?>
		<!-- a href="#" id="clearall" class="ui-btn ui-btn-icon-left ui-icon-delete">Clear All Scanned</a -->
		</div>
	</div>
</div>