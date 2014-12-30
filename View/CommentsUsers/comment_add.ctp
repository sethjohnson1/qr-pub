<?
//I think this same view will be used for all the comments, not just add
//this should be a loop and formatted just like the comments section on the main view ?>



<? //debug( $this->element('commentsbox',array($user,$comments,$usercomment))); ?>
<?
echo $this->element('commentswidget',$comments,$user);

?>
