	<?$tbheight=52;?>
	<div style="height:<?=$tbheight?>px"></div>
	</div><!-- /content main -->
	<? // this div makes room for the footer so you can scroll below it
		// it DOESN'T WORK with the experimental viewport JS below
	?>
	<style>
			#overlay1 {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			padding: 20px;
			background-color: orange;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.2s ease-in-out;
			-webkit-transform-origin: 0 100%;
			z-index:1000;
		}
				#frame {
			position: fixed;
			top: 30px;
			left: 0;
			width: 100%;
			background-color: blue;
			border: 0;
		}
	</style>


	<? 
	if ($template['Template']['name']=='vgal'|| $template['Template']['name']=='tn') echo $this->element('vgal_lightbox');  
	$transition="slide";
	?>
	<style>
	.buttonstyle{
		width:187px;
		//opacity: .92;
		//height:200px;
		font-size:82px !important;
		margin: 0;
		padding: 0 60px;
	}
	
	.kiosk-footer{
		background-color: #ffffff !important;
		//width: 69% !important;
		opacity: .7;
		margin: 0 auto;
	}
	
	.fontspan{
		font-size:14pt;
		position: relative;
		bottom: -2px;
		padding-right:6px;
	}
	
	.overlay {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			padding: 20px;
			background-color: #ffffff;
			opacity: .7;
			-webkit-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.2s ease-in-out;
			-webkit-transform-origin: 0 100%;
			z-index:1000;
		}
		
	</style>
	<?if (1==1):?>
	<div style=""><!-- experiment container -->
	<div id="overlay" class="overlay">
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

			<?endif;?>
		</div>
		<div class="ui-block-b">
		<span class="fontspan" style="zoom: 1" onclick="$('p,h1,h2,h3,h4').animate({ 'zoom': 1 }, 10 );">A</span>
		<span class="fontspan" style="zoom: 2" onclick="$('p,h1,h2,h3,h4').animate({ 'zoom': 2 }, 10 );">A</span>
		<span class="fontspan" style="zoom: 3" onclick="$('p,h1,h2,h3,h4').animate({ 'zoom': 3 }, 10 );">A</span>
		<span class="fontspan" style="zoom: 4" onclick="$('p,h1,h2,h3,h4').animate({ 'zoom': 4 }, 10 );">A</span>
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
				'escape'=>false,
				//'onclick'=>'resetOverlay()'
				));
			?>
			<script>
			/*
			$(function(){
			  $( "body.ui-mobile-viewport" ).on( "swipeleft", swipeleftHandler );
			 
			  // Callback function references the event target and adds the 'swipeleft' class to it
			  function swipeleftHandler( event ){
			  //this works because the next page is prefetched, not sure what happens if it hasn't loaded yet
				$.mobile.changePage( "#qrpage<? echo $template['Template']['nextid']?>", { transition: "slide"} );
			  }
			});
			*/
			</script>
			<?
			endif;
			?>
		</div>
		</div><!-- /ui-grid -->
	
	</div><!-- /overlay -->
	</div><!-- /container -->
	

	<?endif?>


<script>
	var overlay = document.getElementById('overlay');
	window.addEventListener('scroll', function(e){
  		//document.getElementById('report-scale').innerHTML = document.documentElement.clientWidth/window.innerWidth + " " + window.innerWidth/document.documentElement.clientWidth;
        //document.getElementById('report-left').innerHTML = window.pageXOffset;
		console.log('pageXoffset: '+window.pageXOffset);
       // document.getElementById('report-bottom').innerHTML = window.pageYOffset;
		console.log('pageYoffset: '+window.pageYOffset);
		console.log('innerHeight: '+window.innerHeight);
		console.log('clientHeight: '+document.documentElement.clientHeight);
		console.log(document.documentElement.clientHeight - (window.pageYOffset + window.innerHeight));

		//overlay.style.position = 'absolute';
        overlay.style.left = window.pageXOffset + 'px';
		//overlay.style.bottom = document.documentElement.clientHeight - (window.pageYOffset + window.innerHeight) + 'px';
		overlay.style.bottom = document.documentElement.clientHeight - window.innerHeight + 'px';
      
		overlay.style["-webkit-transform"] = "scale(" + window.innerWidth/document.documentElement.clientWidth + ")";
       // overlay.style["transform"] = "scale(" + window.innerWidth/document.documentElement.clientWidth + ")";


	});

</script>
	<!--div class="kiosk-footer" data-role="footer" data-position="fixed" data-id="myfooter">

	<!--/div--><!-- /footer -->
</div><!-- /page -->