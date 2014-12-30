<?
//debug($comment);
//debug($this->request->data);
foreach ($comments as $comment){
	$flagged=false;
	$mine=0;
	$upvoted=false;
	$downvoted=false;
	if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine=1;

	if (isset($comment['CommentsUser']['id'])){
		//the user has interacted with this comment, set some useful variables
		$flagged=$comment['CommentsUser']['flagged'];
		$upvoted=$comment['CommentsUser']['upvoted'];
		$downvoted=$comment['CommentsUser']['downvoted'];
		//see if its their own comment
	}
		//skip altogether if hidden
		
		if ($mine==1)echo '<div class="mine">';					
		else echo '<div class="notmine">';
	//	debug($comment['Comment']['flags']);
		if($flagged==true || $comment['Comment']['flags']>4)
		{
			$hidden=true;
			$flagvalue=-1; //used later down in link
			$flaglabel='Unflag';
			echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button','id'=>'comment_flag'
			.$comment['Comment']['id'],'label'=>false,'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign',
			'style'=>'float:left'));
			if($flagged==true)
				echo '<p>You flagged this message as inappropriate. Click the Warning icon to unflag.</p>';
			else if($comment['Comment']['flags']>4)
				echo '<p>This message has been flagged as inappropriate '.$comment['Comment']['flags'].' times</p>';
		}
		else
			$hidden=false;
		echo $this->Form->create($comment['Comment']['id']);
		//echo $this->Form->input('comment',array('type'=>'textarea'));		
		//echo $this->Form->input('rating',array('type'=>'number'));
		$toggle='enabled';
		if ($upvoted==true) 
			$toggle='disabled';
		if(!$hidden)
			{echo $this->Form->input('UpVote',array(
			'div'=>false,'label'=>false,
			'type'=>'button','class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-arrow-u','id'=>'comment_up'.$comment['Comment']['id'],$toggle
		));	}
		$toggle='enabled';
		if ($downvoted==true) 
			$toggle='disabled';
		$total=$comment['Comment']['upvotes']-$comment['Comment']['downvotes'];

		//sj- added anchor tag in case we need it
		echo '<a name="'.$comment['Comment']['id'].'"></a>';
		if(!$hidden){
			//debug($comment);
			//set height and overflow "scroll" here to prevent long-winded comments taking up more than their fair share
			$formattedname=explode('^',$comment['User']['username']);
			$formattedname[0]=str_replace('_',' ',$formattedname[0]);
			echo '<div style="width:200px;clear:both"><div class="total" style="float:left">'.$total .'</div>';
			echo '<div style="float:right;"><strong>'.$formattedname[0].'</strong> rated '.$comment['Comment']['rating'].'/5 '
			.'<br/> '.$comment['Comment']['thoughts'].'</div></div>';
			echo '<div style="clear:both">&nbsp;</div>';
		echo $this->Form->input('DownVote',array(
			'div'=>false,'label'=>false,
			'type'=>'button','class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-arrow-d','id'=>'comment_down'.$comment['Comment']['id'],$toggle
			));	
		
		if ($flagged==true){
			$flagvalue=-1; //used later down in link
			$flaglabel='Unflag';
		}
		else {
			$flagvalue=1;
			$flaglabel='Flag';
		}
		//echo '<div style="clear:all">&nbsp</div>';
		echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button',
			'id'=>'comment_flag'.$comment['Comment']['id'],'label'=>false,'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert'
		
		));
		
		if ($mine==1){
			echo $this->Form->input('Delete my Comment',array(
			'div'=>true,'label'=>false,
			'type'=>'button','id'=>'comment_hide'.$comment['Comment']['id'],'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-delete'
		));	
		}
	}

	//not sure even want to bother with nested. If so, it should be limited to 2 levels deep	
		//echo $this->Form->input('Reply',array('type'=>'button','id'=>'comment_reply'.$comment['Comment']['id'],'label'=>false));	
		
		//echo $this->Form->submit('Submit');
		echo $this->Form->end(); 
	
		/*$data = $this->Js->get('#'.$comment['Comment']['id'].'CommentAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
		$this->Js->get('#comment_up'.$comment['Comment']['id'])->event(
			'click', $this->Js->request(
				array('controller' => 'commentsUsers', 'action' => 'comment_up',$comment['Comment']['id'],$comment['Comment']['template_id'],1), array(
					'update' => '#comments',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
					)
				)
		);
	
		$this->Js->get('#comment_down'.$comment['Comment']['id'])->event(
			'click', $this->Js->request(
				array('controller' => 'commentsUsers', 'action' => 'comment_up',$comment['Comment']['id'],$comment['Comment']['template_id'],-1), array(
					'update' => '#comments',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
					)
				)
		);
	
		$this->Js->get('#comment_flag'.$comment['Comment']['id'])->event(
			'click', $this->Js->request(
				array('controller' => 'commentsUsers', 'action' => 'comment_flag',$comment['Comment']['id'],$comment['Comment']['template_id'],$flagvalue), array(
					'update' => '#comments',
					'async' => true,
					'data'=>$data,
					'dataExpression'=>true,
					'method'=>'POST'
					)
				)
		);

		if ($mine==1){
			$this->Js->get('#comment_hide'.$comment['Comment']['id'])->event(
				'click', $this->Js->request(
					array('controller' => 'commentsUsers', 'action' => 'comment_hide',$comment['Comment']['id']), array(
						'update' => '#comments',
						'async' => true,
						'data'=>$data,
						'dataExpression'=>true,
						'method'=>'POST'
						)
					)
			);
		}
		
		
		echo $this->Js->writeBuffer();
		//debug($comment);
		*/
		
		
		echo '<div>&nbsp;</div>';
	echo '</div>';
	?>
<script type="text/javascript">
//<![CDATA[
$(document).on('pagebeforeshow', function(){       
    $(document).off('click', '#comment_hide<? echo $comment['Comment']['id']; ?>').on('click', '#comment_hide<? echo $comment['Comment']['id']; ?>',function(e) {
		$.ajax({
		async:true,
		data:$("#<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			//$('#comments').remove();
			//$('<div id="comments"></div>').appendTo('#comments_container');
			$(".comments<? echo $id ?>").html(data).trigger('create');
			//$('#comments_box').remove();
			//$('<div id="comments_box"></div>').appendTo('#comments_container');
			//$('#sCommentViewForm')[0].reset(); 
			console.log(data);
		},
		type:"POST",
		url:"http://ngin/qr-pub/commentsUsers/comment_hide/<? echo $comment['Comment']['id']; ?>"});
		return false;
    }); 
});
//]]>
</script>
<? } //end the awesome foreach loop?>
