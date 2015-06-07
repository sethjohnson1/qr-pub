<?

echo $this->Session->flash('commentFlash');
foreach ($comments as $comment){
	$this->set(compact('comment'));
	echo $this->element('comments_single_comment',array($comment,$user));
 }
 ?>
