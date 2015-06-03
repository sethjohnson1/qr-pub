<div class="comments_container" style="clear:both;">
<div class="ui-shadow ui-corner-all custom-corners comments_box">
	<div class="ui-bar ui-bar-a">
		<h2>Comment and Rate</h2>
	</div>
	<div class="ui-body ui-body-a">
<? 
	$allow=1;
	echo $this->Form->create('sComment',array('class'=>'sCommentViewForm'.$id));
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
	
	echo $this->Form->input('rating',array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>'Your Approval rating'));		
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
		if(empty($user))$user='';
		$hide_stuff
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
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
</script>