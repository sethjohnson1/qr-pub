<?
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
			echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button','id'=>'comment_flag'.$comment['Comment']['id'],'label'=>false,'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign','style'=>'float:left'));
			if($flagged==true)
				echo '<p>this message was falgged Click the Warning to see the Flagged messaged</p>';
			else if($comment['Comment']['flags']>4)
				echo '<p>Click the Warning to see the Flagged messaged has been flagged '.$comment['Comment']['flags'].' times</p>';
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

		echo '<div style="width:200px;clear:both"><div class="total" style="float:left">'.$total .'</div>';
		echo '<div style="float:right;">User thinks: '.$comment['Comment']['thoughts'].'</div></div>';
		echo '<div style="clear:both">&nbsp;</div>';
		if(!$hidden){
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
	
		$data = $this->Js->get('#'.$comment['Comment']['id'].'CommentAddForm')->serializeForm(array('isForm' => true, 'inline' => true));
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
		
		
		//.$comment['Comment']['id'].'     '.$total.'<br />';
		
		echo '<div>&nbsp;</div>';
	echo '</div>';
		
		
	
	
}