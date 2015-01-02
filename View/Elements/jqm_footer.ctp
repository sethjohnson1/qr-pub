	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<!--right here we need 2 pull out Qs that 1 for score card and 1 for comments, then also design those panels-->
		<div class="ui-grid-d" style="text-align:center;position: relative;top: 7px;">
			<? 
			//debug($template['Template']);
			if (isset($template['Template']['previd'])):
				echo $this->Html->link('Previous',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),
				array('style'=>'width: 100px;',
				'data-role'=>'button',
				'data-icon'=>'arrow-l',
				'data-iconpos'=>'left',
				'data-transition'=>'slide',
				'data-theme'=>'e',
				'data-direction'=>'reverse'
				));
			/*
				I am abandoning swiping for now. It doesn't work at all on iPad and sort of sucks
				on Android anyway I am leaving the code here in case we want to revisit it sometime
			*/
			?>
			<!-- script>
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
			</script -->
			<?
			endif;
	
			//echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			if (isset($template['Template']['nextid'])):
				echo $this->Html->link('Next',array('controller'=>'templates','action'=>'view',$template['Template']['nextid']),
				array('style'=>'width: 100px;',
				'data-role'=>'button',
				'data-icon'=>'arrow-r',
				'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-transition'=>'slide',
				'data-theme'=>'e'
				));
			?>
			<!-- script>
			//<![CDATA[
			$(function(){
			  $( "div.ui-content" ).on( "swipeleft", swipeleftHandler );
			 
			  // Callback function references the event target and adds the 'swipeleft' class to it
			  function swipeleftHandler( event ){
			  //this works because the next page is prefetched, not sure what happens if it hasn't loaded yet
				$.mobile.changePage( "#qrpage<? echo $template['Template']['nextid']?>", { transition: "slide"} );
			  }
			});
			//]]>
			</script -->
			<?
			endif;
			//allow the following script is not perfect, it works for most situations (
			?>

		</div><!-- /ui-grid -->
	</div><!-- /footer -->
</div><!-- /page -->