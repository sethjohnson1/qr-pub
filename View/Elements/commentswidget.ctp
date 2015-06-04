<?
if (isset($is_kiosk)) $is_kiosk=$is_kiosk;
else $is_kiosk='';
if (isset($hide_stuff)) $hide_stuff=$hide_stuff;
else $hide_stuff='';

echo $this->Session->flash('commentFlash');
foreach ($comments as $comment){
	$this->set(compact('comment','is_kiosk','hide_stuff'));
	echo $this->element('comments_single_comment',array($comment,$user));
 }
 ?>
