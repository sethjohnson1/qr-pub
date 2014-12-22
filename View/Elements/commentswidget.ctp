<?
foreach ($comments as $comment){
	$flagged=false;
	$mine=0;
	$upvoted=false;
	$downvoted=false;
	//debug($usercomments);
	if (isset($usercomments['CommentsUser']['id']) && $comment['Comment']['id']==$usercomments['CommentsUser']['comment_id']){
		//we are at this users comment, so here is where logic of how to draw buttons is derived
		$mine=1;
		$flagged=$usercomments['CommentsUser']['flagged'];
		$upvoted=$usercomments['CommentsUser']['upvoted'];
		$downvoted=$usercomments['CommentsUser']['downvoted'];
		//debug($flagged);
	}
	echo '<div style="border: 1px double green">';
		echo $this->Form->create($comment['Comment']['id']);
		//echo $this->Form->input('comment',array('type'=>'textarea'));		
		//echo $this->Form->input('rating',array('type'=>'number'));
		$toggle='enabled';
		if ($upvoted==true) $toggle='disabled';
		echo $this->Form->input('UpVote',array(
			'div'=>false,'label'=>'[ + ]'.$comment['Comment']['upvotes'],
			'type'=>'button','id'=>'comment_up'.$comment['Comment']['id'],$toggle
		));	
		$toggle='enabled';
		if ($downvoted==true) $toggle='disabled';
		echo $this->Form->input('DownVote',array(
			'div'=>false,'label'=>'[ + ]'.$comment['Comment']['downvotes'],
			'type'=>'button','id'=>'comment_down'.$comment['Comment']['id'],$toggle
			));	
		if ($flagged==true){
			$flagvalue=-1; //used later down in link
			$flaglabel='Unflag';
		}
		else {
			$flagvalue=1;
			$flaglabel='Flag';
		}
		echo $this->Form->input($flaglabel,array('div'=>false,'type'=>'button',
		'id'=>'comment_flag'.$comment['Comment']['id'],'label'=>false
		
		));

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
		
		if ($flagged==false) $flagvalue=1;
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
		
		echo $this->Js->writeBuffer();
		$total=$comment['Comment']['upvotes']-$comment['Comment']['downvotes'];
		echo $comment['Comment']['thoughts'].'<br />'
		.$comment['Comment']['id'].'     '.$total.'<br />';
		
		echo '</div>';
	
	
}