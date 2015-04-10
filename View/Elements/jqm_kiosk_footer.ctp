	</div><!-- /content main -->
	<? 
	if ($template['Template']['name']=='vgal'|| $template['Template']['name']=='tn') echo $this->element('vgal_lightbox');  
	$transition="slide";
	?>
	<style>
	.buttonstyle{
		width:152px;
		//opacity: .92;
		//height:200px;
		font-size:104px !important;
		margin: 0;
		padding: 0;
	}
	
	.kiosk-footer{
		background-color: #ffffff !important;
		width: 69% !important;
		opacity: .7;
		margin: 0 auto;
	}
	
	.fontspan{
		font-size:14pt;
		position: relative;
		bottom: -4px;
		padding-right:6px;
	}
	</style>
	<div class="kiosk-footer" data-role="footer" data-position="fixed" data-id="myfooter">
		<div class="ui-grid-b" style="text-align:center;position: relative;top: 7px;">
		<div class="ui-block-a">
			<? 
			//$buttonstyle='max-width: 100px; opacity: .92; min-width:';
			if (isset($template['Template']['previd'])):
				echo $this->Html->link('&#8666;',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
				//'data-icon'=>'arrow-l',
				//'data-iconpos'=>'left',
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'g',
				'data-direction'=>'reverse',
				'escape'=>false
				));
			/*
				swiping is only for Kiosk mode. it Doesn't work at all on iOS and isn't perfect anyway
				if I get complaints I will just remove it
			*/
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
			<?endif;?>
		</div>
		<div class="ui-block-b">
		<span class="fontspan" style="zoom: 1">A</span>
		<span class="fontspan" style="zoom: 2">A</span>
		<span class="fontspan" style="zoom: 3">A</span>
		<span class="fontspan" style="zoom: 4">A</span>
		</div>
		<div class="ui-block-c">
		<?
			if (isset($template['Template']['nextid'])):
				echo $this->Html->link('&#8667;',array('controller'=>'templates','action'=>'view',$template['Template']['nextid'],'?'=>array('next'=>1)),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
				//'data-icon'=>'arrow-r',
				//'data-iconpos'=>'right',
				'data-prefetch'=>true,
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'g',
				'escape'=>false
				));
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
			?>
		</div>
		</div><!-- /ui-grid -->
	</div><!-- /footer -->
</div><!-- /page -->