<?
//debug($comments);
echo $this->Session->flash('commentFlash');
foreach ($comments as $comment){
	$flagged=false;
	$mine=0;
	$upvoted=false;
	$downvoted=false;
	echo $this->Form->create($comment['Comment']['id']);
	if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine=1;

	if (isset($comment['CommentsUser']['id'])){
		//the user has interacted with this comment, set some useful variables
		$flagged=$comment['CommentsUser']['flagged'];
		$upvoted=$comment['CommentsUser']['upvoted'];
		$downvoted=$comment['CommentsUser']['downvoted'];
		//see if its their own comment
	}
	//set flagvalue
	if ($flagged==true){
		$flagvalue=-1; //used later down in link
		$flaglabel='Unflag';
	}
	else {
		$flagvalue=1;
		$flaglabel='Flag';
		}
		

		if ($mine==1)echo '<div class="mine">';					
		else echo '<div class="notmine">';
		//debug($cookie_flags);
		if($flagged==true || $comment['Comment']['flags']>4 || isset($cookie_flags[$comment['Comment']['id']]))
		{
			$hidden=true;
			$flagvalue=-1; //used later down in link
			$flaglabel='Unflag';
			echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button',
			//'id'=>'comment_flag'.$comment['Comment']['id'],
			'label'=>false,'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'
			.$comment['Comment']['id'],
			'style'=>'float:left'));
			
			if($flagged==true || isset($cookie_flags[$comment['Comment']['id']]))
				echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment, please unflag using the icon and vote it down instead.</p>';
			else if($comment['Comment']['flags']>4)
				echo '<p>This message has been flagged as inappropriate '.$comment['Comment']['flags'].' times</p>';
		}
		else $hidden=false;
		
		$toggle='enabled';
		if ($upvoted==true) 
			$toggle='disabled';
		if(!$hidden){
			echo $this->Form->input('UpVote',array(
			'div'=>false,'label'=>false,
			'type'=>'button','class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-arrow-u'.' comment_up'.$comment['Comment']['id'],
			//'id'=>'comment_up'.$comment['Comment']['id'],
			$toggle
		));	}
		$toggle='enabled';
		if ($downvoted==true) 
			$toggle='disabled';
		$total=$comment['Comment']['upvotes']-$comment['Comment']['downvotes'];

		if(!$hidden){
			//set height and overflow "scroll" here to prevent long-winded comments taking up more than their fair share
			$formattedname=explode('^',$comment['Comment']['User']['username']);
			$formattedname[0]=str_replace('_',' ',$formattedname[0]);
			echo '<div style="width:200px;clear:both"><div class="total" style="float:left">'.$total .'</div>';
			echo '<div style="float:right;"><strong>'.$formattedname[0].'</strong> rated '.$comment['Comment']['rating'].'/5 '
			.'<br/> '.$comment['Comment']['thoughts'].'</div></div>';
			echo '<div style="clear:both">&nbsp;</div>';
			echo $this->Form->input('DownVote',array(
				'div'=>false,'label'=>false,
				'type'=>'button','class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-arrow-d'.' comment_down'.$comment['Comment']['id'],
				//'id'=>'comment_down'.$comment['Comment']['id'],
				$toggle
			));	
		//end down
		
		//echo '<div style="clear:all">&nbsp</div>';
		echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button',
			//'id'=>'comment_flag'.$comment['Comment']['id'],
			'label'=>false,'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert'.' comment_flag'.$comment['Comment']['id']
		
		));
		
		if ($mine==1){
			echo $this->Form->input('Delete my Comment',array(
			'div'=>true,'label'=>false,
			'type'=>'button',
			//'id'=>'comment_hide'.$comment['Comment']['id'],
			'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-delete'.' comment_hide'.$comment['Comment']['id']
			,'rel'=>'external','data-ajax'=>'false'
		));	
		}
	}

	//not sure even want to bother with nested. If so, it should be limited to 2 levels deep	
		//echo $this->Form->input('Reply',array('type'=>'button','id'=>'comment_reply'.$comment['Comment']['id'],'label'=>false));	

		echo $this->Form->end(); 		
		echo '<div>&nbsp;</div>';
	echo '</div>';
	//debug($comments);
	?>
	
<script type="text/javascript">
//<![CDATA[
//$(document).on('pagebeforeshow', function(){ don't need this here, because the page is not reloading when this happen       
    $(document).off('click', '.comment_hide<? echo $comment['Comment']['id']; ?>').on('click', '.comment_hide<? echo $comment['Comment']['id']; ?>',function(e) {
		console.log('click');
		$.ajax({
		async:true,
		data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			//$('#comments').remove();
			//$('<div id="comments"></div>').appendTo('#comments_container');
			$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
			//$('#comments_box').remove();
			//$('<div id="comments_box"></div>').appendTo('#comments_container');
			//$('#sCommentViewForm')[0].reset(); 
			//console.log(data);
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_hide/<? echo $comment['Comment']['id']; ?>"});
		return false;
    }); 
	
	$(document).off('click', '.comment_up<? echo $comment['Comment']['id']; ?>').on('click', '.comment_up<? echo $comment['Comment']['id']; ?>',function(e) {
		$.ajax({
		async:true,
		data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_up/<? echo $comment['Comment']['id']; ?>/<? echo $comment['Comment']['template_id']; ?>/1"});
		return false;
    });
	
	$(document).off('click', '.comment_down<? echo $comment['Comment']['id']; ?>').on('click', '.comment_down<? echo $comment['Comment']['id']; ?>',function(e) {
		$.ajax({
		async:true,
		data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_up/<? echo $comment['Comment']['id']; ?>/<? echo $comment['Comment']['template_id']; ?>/-1"});
		return false;
    });


//$(document).on('updatelayout', function(){
	$(document).off('click', '.comment_flag<? echo $comment['Comment']['id']; ?>').on('click', '.comment_flag<? echo $comment['Comment']['id']; ?>',function(e) {
		$.ajax({
		async:true,
		data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
		},
		type:"POST",
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_flag/<? echo $comment['Comment']['id'].'/'.$comment['Comment']['template_id'].'/'.$flagvalue?>"});
		return false;
    });
//});
	
//});
//]]>
</script>
<? } //end the awesome foreach loop?>
