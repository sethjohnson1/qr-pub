<?
/* this ALL needs to be PHP!! otherwise it won't load in JS properly */
echo '<h3>Comments</h3>';
if (isset($user)){
	echo $this->Form->create('sComment',array(
		//'url'=>array('controller'=>'commentsUsers','action' => 'comment_add',$id),
		//'data-ajax'=>'false'
	));
	//echo $this->Form->input('vgalid');
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
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts,'label'=>$labelcomment));		
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>false));		
	echo $this->Form->input('Add',array('type'=>'button','id'=>'comment_add','label'=>false));	
	
	//echo $this->Form->submit('Submit',array('id'=>'submit_button'));
	echo $this->Form->end(); 

	/*
	$data = $this->Js->get('#sCommentViewForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#comment_add')->event(
        'click', $this->Js->request(
            array('controller' => 'commentsUsers', 'action' => 'comment_add',$id), array(
				'update' => '#comments',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );
	
	echo $this->Js->writeBuffer();
	*/
 }
 else {
	$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window'));
	echo 'Join in! '.$loginlink.'<br />';
	}
?>