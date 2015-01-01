<?
//debug($comments);
echo $this->Session->flash('commentFlash');
foreach ($comments as $comment){
	$this->set('comment',$comment);
	//debug($user);
	echo $this->element('comments_single_comment',array($comment,$user));
 }
 ?>
