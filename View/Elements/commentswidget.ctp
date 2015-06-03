<?
if (isset($is_kiosk)) $is_kiosk=$is_kiosk;
else $is_kiosk='';


echo $this->Session->flash('commentFlash');
foreach ($comments as $comment){
	$this->set(compact('comment','is_kiosk'));
	echo $this->element('comments_single_comment',array($comment,$user));
 }
 ?>
