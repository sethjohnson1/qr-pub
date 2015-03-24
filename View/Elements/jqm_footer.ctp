	</div><!-- /content main -->
	<? 
	if ($template['Template']['name']=='vgal'|| $template['Template']['name']=='tn') echo $this->element('vgal_lightbox');  
	$transition="slide";
	?>
	<style>
	.buttonstyle{
		width:100px;
		opacity: .92;
	}
	</style>
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
		<div class="ui-grid-a" style="text-align:center;position: relative;top: 7px;">
		<div class="ui-block-a">
			<? 
			if (isset($template['Template']['previd'])){
				echo $this->Html->link('Previous',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
				'data-icon'=>'arrow-l',
				'data-iconpos'=>'left',
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'f',
				'data-direction'=>'reverse'
				));}
			?>
		</div>
		<div class="ui-block-b">
		<?
			//echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			//query string is used so AppController doesn't write the location as Session variable (see issue #59)
			if (isset($template['Template']['nextid'])){
				echo $this->Html->link('Next',array('controller'=>'templates','action'=>'view',$template['Template']['nextid'],'?'=>array('next'=>1)),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
				'data-icon'=>'arrow-r',
				'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'f'
				));}
				?>
		</div>
		</div><!-- /ui-grid -->
	</div><!-- /footer -->
</div><!-- /page -->