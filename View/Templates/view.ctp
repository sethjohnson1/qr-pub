<?
echo $this->element('jqm_header',$template);

//debug($template);
if ($template['Template']['name']=='vgal') echo $this->element('vgal',array($template));
if ($template['Template']['name']=='blog') echo $this->element('blog',array($template));
/*
comments need some basic styling now. Not using popup, just list at end.
*/
?>

<div class="comments_container" style="clear:both;">
<div class="ui-corner-all custom-corners comments_box">
	<div class="ui-bar ui-bar-a">
		<h2>Comment and Rate</h2>
	</div>
	<div class="ui-body ui-body-a">
<? if (isset($user['id'])){
	$allow=1;
	echo $this->Form->create('sComment',array(
		//'url'=>array('controller'=>'commentsUsers','action' => 'comment_add',$id),
		//'data-ajax'=>'false',
		'class'=>'sCommentViewForm'.$id
	));
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
	//echo heading here
	echo $this->Form->input('id',array('type'=>'hidden','value'=>$template['Template']['id']));		
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts,'label'=>false));		
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>$rating,'label'=>false));		
	echo $this->Form->input('Add',array('type'=>'button','class'=>'comment_add'.$id,'id'=>'comment_add','label'=>false));	
	
	//echo $this->Form->submit('Submit',array('id'=>'submit_button'));
	echo $this->Form->end();
 }
 else {
	$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'turn'));
	echo 'To ensure the fidelity of information supplied, we request you login. <br />'
	.$loginlink.'<br />';
	}
	?>
	</div>
</div>
<br />
<div class="ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-a">
		<h2>Comments</h2>
	</div>
	<div id="comments" class="ui-body ui-body-a comments<? echo $id; ?>">

		<? 
		//debug($template);
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>

	</div>
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
		url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
//]]>
</script>
<?
echo $this->element('jqm_basic_footer');
?>