	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<!--right here we need 2 pull out Qs that 1 for score card and 1 for comments, then also design those panels-->
		<div class="ui-grid-d" style="text-align:center;position: relative;top: 7px;">
			<? 
			//echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			//echo $this->Html->link('Comments','#comments',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));
			?>
		</div>
			<script>
			//<![CDATA[
			$(function(){
			  $( "div.ui-content" ).on( "swiperight", swiperightHandler );
				function swiperightHandler( event ){ 
					$.mobile.back();
				}
			});
			//]]>
			</script>
	</div><!-- /footer -->
</div><!-- /page -->