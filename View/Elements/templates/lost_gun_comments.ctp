<?
$thoughts='';
$btn_text='Add';
if (isset($usercomment['Comment']['thoughts']) && isset($usercomment['User']['id'])){
 $thoughts=$usercomment['Comment']['thoughts'];
 $btn_text='Update';
 }
?>
<script>
$( document ).on( "pagecontainershow", function( event, ui ) {
	//cleanup and redisplay
	$('.lost_gun_comments').show();
	$('.lost_gun_success').hide();
	$('#lost_gun_input').val('<?=$thoughts?>');
	$('.js_time_stamp_field').val(Date.now());
	$('.class<?=$kioskmode?>').removeAttr('disabled');
});
</script>
<div class="comments_container" style="clear:both;">
<div class="ui-shadow ui-corner-all custom-corners comments_box lost_gun_comments">

	<div class="ui-body ui-body-a">
	<h1>What do you think happened?</h1>
<? 
	$allow=1;
	echo $this->Form->create('sComment',array('class'=>'sCommentViewForm'.$id));
	echo $this->Form->input('id',array('type'=>'hidden','value'=>$template['Template']['id']));		

	//set rating very high so we can use it as a flag to know to hide it in single_comment_view
	echo $this->Form->input('rating',array('type'=>'hidden','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>999,'label'=>'Your Approval rating'));		
	echo $this->Form->input('comment',array('type'=>'textarea','placeholder'=>'Tell your story of the magical, mystical Lost Gun of the Something-or-other','label'=>false,'id'=>'lost_gun_input'));		
	if (isset($user['id'])){
		echo $this->Form->input($btn_text,array('type'=>'button','class'=>'comment_add'.$id,'id'=>'comment_add','label'=>false));	
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
<div class="ui-shadow ui-corner-all custom-corners lost_gun_success" style="display: none;">
<h1>Great now look through and vote on your favorites!</h1>
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
		<h2>Other stories</h2>
	</div>
	<div class="ui-body ui-body-a comments<? echo $id; ?>">

		<? 
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>

	</div>
</div>
</div>
<script type="text/javascript">
$(document).on('pagebeforeshow', function(){       
    $(document).off('click', '.comment_add<? echo $id; ?>').on('click', '.comment_add<? echo $id; ?>',function(e) {
		$.ajax({
		async:true,
		data:$(".sCommentViewForm<? echo $id; ?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$(".comments<? echo $id ?>").html(data).trigger('create');
			//hide the box
			$('.lost_gun_comments').fadeToggle();
			$('.lost_gun_success').fadeToggle();
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
</script>