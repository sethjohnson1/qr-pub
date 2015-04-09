</div><!-- /content main -->
	<? 
	if ($template['Template']['name']=='vgal'|| $template['Template']['name']=='tn') echo $this->element('vgal_lightbox');  
	$transition="slide";
	?>
	<style>
	.buttonstyle{
		width:152px;
		opacity: .92;
		//height:200px;
		font-size:104px !important;
		margin: 0;
		padding: 0;
	}

		
/* using this method rather than JQM so that links behind prev and next button can be clicked */
	.custom-footer {
		position: fixed;
		/* ui-content is z-index: 999 so this is exactly one above, stays behind popups though*/
		z-index: 1000;
		width: 160px;
		bottom: 0;
	} 
	.next-footer{
		right: 2%;
	}
	.prev-footer{
		left: 2%;
	}
	</style>
	<script>
	$(function(){
			  $( "div.ui-content" ).on( "swiperight", swiperightHandler );
				function swiperightHandler( event ){ 
					//this is how to easily go back, but it doesn't always work well
					//$.mobile.back();
					$.mobile.changePage( "#qrpage<? echo $template['Template']['previd']?>", { reverse: true, transition: "slide"} );
				}
	});
	
	$(function(){
			  $( "body.ui-mobile-viewport" ).on( "swipeleft", swipeleftHandler );
			 
			  // Callback function references the event target and adds the 'swipeleft' class to it
			  function swipeleftHandler( event ){
			  //this works because the next page is prefetched, not sure what happens if it hasn't loaded yet
				$.mobile.changePage( "#qrpage<? echo $template['Template']['nextid']?>", { transition: "slide"} );
			  }
	});
	</script>
	
	<?if (isset($template['Template']['previd'])):?>
	<div class="custom-footer prev-footer">
	<?=$this->Html->link('&#8666;',array('controller'=>'templates','action'=>'view',$template['Template']['previd']),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'g',
				'data-direction'=>'reverse',
				'escape'=>false
				))?>
	</div><!-- /prev-footer -->
	<?endif?>
	<?if (isset($template['Template']['nextid'])):?>
	<div class="custom-footer next-footer">
	<?=
				 $this->Html->link('&#8667;',array('controller'=>'templates','action'=>'view',$template['Template']['nextid'],'?'=>array('next'=>1)),
				array(
				'class'=>'buttonstyle',
				'data-role'=>'button',
	
				'data-prefetch'=>true,
				'data-transition'=>$transition,
				//this can be changed back to 'e' for brown buttons
				'data-theme'=>'g',
				'escape'=>false
				));?>
	</div><!-- /next-footer -->
	<?endif?>
	
<!-- room for the floating buttons at the bottom -->
	<div style="height:150px"></div>
	</div><!-- /page -->