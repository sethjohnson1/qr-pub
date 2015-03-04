	</div><!-- /content main -->
	<? 
	if ($template['Template']['name']=='vgal'|| $template['Template']['name']=='tn') echo $this->element('vgal_lightbox');  
	$transition="slide";
	?>
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
		<div class="ui-grid-d" style="text-align:center;position: relative;top: 7px;">
			<? 
			$buttonstyle='width: 100px; opacity: .92;';
			if (isset($template['Template']['previd'])):
				echo $this->Html->link('Previous',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),
				array('style'=>$buttonstyle,
				'data-role'=>'button',
				'data-icon'=>'arrow-l',
				'data-iconpos'=>'left',
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'f',
				'data-direction'=>'reverse'
				));
			/*
				swiping is only for Kiosk mode. it Doesn't work at all on iOS and isn't perfect anyway
				if I get complaints I will just remove it
			*/
			if (Configure::read('enableKioskMode')==1):
			?>
			<script>
			//<![CDATA[
			$(function(){
			  $( "div.ui-content" ).on( "swiperight", swiperightHandler );
				function swiperightHandler( event ){ 
					//this is how to easily go back, but it doesn't always work well
					//$.mobile.back();
					$.mobile.changePage( "#qrpage<? echo $template['Template']['previd']?>", { reverse: true, transition: "slide"} );
				}
			});
			//]]>
			</script>
			<?
			endif;
			endif;
	
			//echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			//query string is used so AppController doesn't write the location as Session variable (see issue #59)
			if (isset($template['Template']['nextid'])):
				echo $this->Html->link('Next',array('controller'=>'templates','action'=>'view',$template['Template']['nextid'],'?'=>array('next'=>1)),
				array('style'=>$buttonstyle,
				'data-role'=>'button',
				'data-icon'=>'arrow-r',
				'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'f'
				));
			//the swiping scripts are about as good as they can be for now, only used for kiosk
			if (Configure::read('enableKioskMode')==1):
			?>
			<script>
			//<![CDATA[
			$(function(){
			  $( "body.ui-mobile-viewport" ).on( "swipeleft", swipeleftHandler );
			 
			  // Callback function references the event target and adds the 'swipeleft' class to it
			  function swipeleftHandler( event ){
			  //this works because the next page is prefetched, not sure what happens if it hasn't loaded yet
				$.mobile.changePage( "#qrpage<? echo $template['Template']['nextid']?>", { transition: "slide"} );
			  }
			});
			//]]>
			</script>
			<?
			endif;
			endif;
			//allow the following script is not perfect, it works for most situations (
			?>

		</div><!-- /ui-grid -->
	</div><!-- /footer -->
</div><!-- /page -->