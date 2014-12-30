	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<!--right here we need 2 pull out Qs that 1 for score card and 1 for comments, then also design those panels-->
		<div class="ui-grid-d" style="text-align:center;position: relative;top: 7px;">
			<? 
			//debug($template['Template']);
			if (isset($template['Template']['previd']))
				echo $this->Html->link('Previous',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),array('style'=>'width: 100px;',
				'class'=>'ui-btn ui-icon-arrow-l ui-btn-icon-top','data-transition'=>'slide','data-direction'=>'reverse'
				//,'rel'=>'external' //the only way the forms work right now
				));
			echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			if (isset($template['Template']['nextid']))
				echo $this->Html->link('Next',array('controller'=>'templates','action'=>'view',$template['Template']['nextid']),array('style'=>'width: 100px;','class'=>'ui-btn ui-icon-arrow-r ui-btn-icon-top',
			'data-prefetch'=>true,'data-transition'=>'slide'
			//,'rel'=>'external'
			));
			//echo $this->Html->link('Comments','#comments',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			?>
		</div>
	</div><!-- /footer -->
</div><!-- /page -->