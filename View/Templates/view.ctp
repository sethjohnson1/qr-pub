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
if (empty($kioskmode) && $template['Asset'][0]['allow_comments']==1):
	//begin overlay check here
	echo $this->element('overlay');
?>
<div class="comments_container" style="clear:both;">
<div class="ui-shadow ui-corner-all custom-corners comments_box">
	<div class="ui-bar ui-bar-a">
		<h2>Comment and Rate</h2>
	</div>
	<div class="ui-body ui-body-a">
<? 
	$allow=1;
	echo $this->Form->create('sComment',array(
		//'url'=>array('controller'=>'commentsUsers','action' => 'comment_add',$id),
		//'data-ajax'=>'false',
		'class'=>'sCommentViewForm'.$id
	));
	if (isset($usercomment['Comment']['thoughts'])) {
		$thoughts=$usercomment['Comment']['thoughts'];
		$rating=$usercomment['Comment']['rating'];
		$labelcomment='Edit your comment and rating';
	}
	else { 
		$thoughts='';
		$rating=3;
		$labelcomment='Add a comment and rating';
	}
	//echo heading here
	echo $this->Form->input('id',array('type'=>'hidden','value'=>$template['Template']['id']));		
	
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>'Your Approval rating'));		
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts,'label'=>'Your thoughts'));		
	if (isset($user['id'])){
		echo $this->Form->input('Add',array('type'=>'button','class'=>'comment_add'.$id,'id'=>'comment_add','label'=>false));	
	}
	else {
		$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'pop'));
		echo 'To ensure the fidelity of information supplied, you must login first.<br />'
		.$loginlink.'<br />';
	}
		//echo $this->Form->submit('Submit',array('id'=>'submit_button'));
	echo $this->Form->end();
	?>
	</div>
</div>
<br />
	<style type="text/css" scoped>
		.big_comment_container{
		
		}

		div[class^="commentsbox_"]{
			border: 10px solid black;
		}
		
	</style>
<div class="big_comment_container ui-shadow ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-a">
		<h2>Comments</h2>
	</div>
	<div class="ui-body ui-body-a comments<? echo $id; ?>">

		<? 
		//debug($template);
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>

	</div>
</div>
</div>
<? //echo $this->element('ajax_scripts',array($id)); ?>
<script type="text/javascript">
//<![CDATA[
$(document).on('pagebeforeshow', function(){       
    $(document).off('click', '.comment_add<? echo $id; ?>').on('click', '.comment_add<? echo $id; ?>',function(e) {
	//console.log('click');
		$.ajax({
		async:true,
		data:$(".sCommentViewForm<? echo $id; ?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			//$('#comments').remove();
			//$('<div id="comments"></div>').appendTo('#comments_container');
			$(".comments<? echo $id ?>").html(data).trigger('create');
			//$('#comments_box').remove();
			//$('<div id="comments_box"></div>').appendTo('#comments_container');
			//$('#sCommentViewForm')[0].reset(); 
			//console.log(data);
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
//]]>
</script>
<?
endif;
if (!empty($kioskmode)) echo $this->element('jqm_kiosk_footer');
else echo $this->element('jqm_footer');
?>