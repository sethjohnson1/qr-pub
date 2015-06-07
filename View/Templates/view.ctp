<?
echo $this->element('jqm_header');

?>
<!-- script>

$(function() {      
      $(".ui-page").swipe( {
        pinchIn:function(event, direction, distance, duration, fingerCount, pinchZoom)
        {
          //$(this).text("You pinched " +direction + " by " + distance +"px, zoom scale is "+pinchZoom);
         // $('.ui-content').animate({ 'zoom': pinchZoom }, 'slow');
          $('.ui-content').animate({ 'zoom': pinchZoom });

        },
        pinchOut:function(event, direction, distance, duration, fingerCount, pinchZoom)
        {
          //$('.box').text("You pinched " +direction + " by " + distance +"px, zoom scale is "+pinchZoom);
		  if (pinchZoom < 1){pinchZoom=1;}
		  $('.ui-content').animate({ 'zoom': pinchZoom }, 'fast');
        },
        /*pinchStatus:function(event, phase, direction, distance , duration , fingerCount, pinchZoom) {
          $(this).html("Pinch zoom scale "+pinchZoom+"  <br/>Distance pinched "+distance+" <br/>Direction " + direction);
        },*/
        fingers:2,  
        pinchThreshold:0  
      });
    });
</script-->
<?

if ($template['Template']['name']=='vgal' || $template['Template']['name']=='tn') echo $this->element('vgal');
if ($template['Template']['name']=='blog') echo $this->element('blog');
if ($template['Template']['name']=='splash') echo $this->element('splash');
if ($template['Template']['name']=='video') echo $this->element('youtube');
if ($template['Template']['name']=='ag') echo $this->element('ag');
if ($template['Template']['name']=='element') echo $this->element('templates/'.$template['Asset'][0]['filename']);

//allow comments only if not kioskmode and Allow comments on (which DB defaults to)
if (empty($kioskmode) && $template['Template']['allow_comments']==1):
	//begin overlay check here
	echo $this->element('overlay');
	
	echo $this->element('comments_container');
endif;
if (!empty($kioskmode)){
 //sj -testing pinch zoom here, just made copy 
 if ($kioskmode=='pinch') echo $this->element('jqm_kiosk_footer_pinch');
 else echo $this->element('jqm_kiosk_footer');
 
 }
else echo $this->element('jqm_footer');
?>