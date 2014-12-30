<?
echo $this->element('jqm_header',$template);

//debug($id);
if ($template['Template']['name']=='vgal') echo $this->element('vgal',array($template));
?>
<!-- div data-role="popup" id="comments" -->
<?
/* the popup is probably a bad idea, best to just add the comments at the end
basic styling here needs work

*/
?>
<div class="comments_container" style="clear:both;">
<div class="comments_box">
<h3>Comments</h3>
<? if (isset($user)){
	echo $this->Form->create('sComment',array(
		//'url'=>array('controller'=>'commentsUsers','action' => 'comment_add',$id),
		//'data-ajax'=>'false',
		'class'=>'sCommentViewForm'.$id
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
	echo $this->Form->input('id',array('type'=>'hidden','value'=>$template['Template']['id']));		
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts,'label'=>$labelcomment));		
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>false));		
	echo $this->Form->input('Add',array('type'=>'button','class'=>'comment_add'.$id,'id'=>'comment_add','label'=>false));	
	
	//echo $this->Form->submit('Submit',array('id'=>'submit_button'));
	echo $this->Form->end();
 }
 else {
	$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window'));
	echo 'Join in! '.$loginlink.'<br />';
	}
	?>
</div>
	<div id="comments" class="comments<? echo $id; ?>" style="border: solid black; padding: 12px 12px 12px 12px">

		<? 
		//debug($template);
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>

	</div>
</div>
<? //echo $this->element('ajax_scripts',array($id)); ?>
<script type="text/javascript">
//<![CDATA[
$(document).on('pagebeforeshow', function(){       
    $(document).off('click', '.comment_add<? echo $id; ?>').on('click', '.comment_add<? echo $id; ?>',function(e) {
		$.ajax({
		async:true,
		data:$(".sCommentViewForm<? echo $id; ?>").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			//$('#comments').remove();
			//$('<div id="comments"></div>').appendTo('#comments_container');
			$(".comments<? echo $id ?>").html(data).trigger('create');
			//$('#comments_box').remove();
			//$('<div id="comments_box"></div>').appendTo('#comments_container');
			//$('#sCommentViewForm')[0].reset(); 
			//console.log(data);
		},
		type:"POST",
		url:"http://ngin/qr-pub/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
//]]>
</script>
<?
echo $this->element('jqm_footer');
?>