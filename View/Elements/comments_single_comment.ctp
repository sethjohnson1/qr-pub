<?
//debug($comment);
$flagged=false;
$mine='notmine';
$utoggle='enabled';
$dtoggle='enabled';
$upvoted=false;
$downvoted=false;
if (isset($comment['Comment']['User']['username'])){
	$formattedname=explode('^',$comment['Comment']['User']['username']);
	$formattedname[0]=str_replace('_',' ',$formattedname[0]);
}

echo $this->Form->create($comment['Comment']['id']);

//see if its their own comment
if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine='mine';
else echo $this->Session->flash('commentFlash');

if (isset($comment['CommentsUser']['id'])){
	//the user has interacted with this comment, set some useful variables
	$flagged=$comment['CommentsUser']['flagged'];
	$upvoted=$comment['CommentsUser']['upvoted'];
	$downvoted=$comment['CommentsUser']['downvoted'];
}

if ($upvoted==true) $utoggle='disabled';
if ($downvoted==true) $dtoggle='disabled';
if ($flagged==true){
	$flagvalue=-1; //used later down in link
	$flaglabel='Unflag';
}
else {
	$flagvalue=1;
	$flaglabel='Flag';
	}
	
?>
	<style type="text/css" scoped>
		.single_comment_container{
		//	border: 2px solid green;
			width:95%;
			max-height: 300px;
		}
		.comment_buttons{
		//	border: 1px solid blue;
		//	width: 15%;
		//	min-width:50px;
			height: 100px;
			float: left;
		}
		.the_comment{
			float:left;
			height: 100px;
			width:82%;
			//overflow: scroll-y;
		//	border: 1px solid yellow;
		}
	
	</style>
	<div class="single_comment_container" >
	<div class="comment_buttons">
			<? echo $this->Form->input('UpVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-u',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_up'.$comment['Comment']['id'],
			$utoggle
		));
		
		echo $this->Form->input('DownVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-d',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_down'.$comment['Comment']['id'],
			$dtoggle
		));
		
		echo $this->Form->input($flaglabel,array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'alert',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_flag'.$comment['Comment']['id']
		));
		
		if ($mine=='mine'){
			echo $this->Form->input('Delete my Comment',array(
				'div'=>false,'label'=>false,
				'type'=>'button',
				'data-role'=>'button',
				'data-icon'=>'delete',
				'data-iconshadow'=>'true',
				'data-iconpos'=>'notext',
				'data-corners'=>'false',
				'class'=>'comment_hide'.$comment['Comment']['id'],
				'rel'=>'external',
				'data-ajax'=>'false'
			));	
		}?>
		
		
	</div>
	<div class="the_comment">
			<ul>
		<li>content</li>
		<li>content</li>
		<li>content</li>
		<li>content</li>
		<li>content</li>
		</ul>
	</div>
	</div>
	<div style="clear:both;">
	</div>


	
<div class="single_comment_container">


	
	<?
	
	//ugh.... fix this later....
	if($flagged==true || $comment['Comment']['flags']>4 || isset($cookie_flags[$comment['Comment']['id']])){
		$hidden=true;
		$flagvalue=-1; //used later down in link
		$flaglabel='Unflag';
		echo $this->Form->input($flaglabel,array(
			'div'=>false,
			'type'=>'button',
			'label'=>false,
			'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
			'style'=>'float:left'
			));
		
		if($flagged==true || isset($cookie_flags[$comment['Comment']['id']]))
			echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment,
			please unflag using the icon and vote it down instead.</p>';
		else if ($comment['Comment']['flags']>4)
			echo '<p>This message has been flagged as inappropriate '.$comment['Comment']['flags'].' times</p>';
	}

	else{ 
	?>


	<div class="comment_buttons ui-body"><?
		echo $this->Form->input('UpVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-u',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_up'.$comment['Comment']['id'],
			$utoggle
		));
		
		echo $this->Form->input('DownVote',array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'arrow-d',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_down'.$comment['Comment']['id'],
			$dtoggle
		));
		
		echo $this->Form->input($flaglabel,array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'alert',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'comment_flag'.$comment['Comment']['id']
		));
		
		if ($mine=='mine'){
			echo $this->Form->input('Delete my Comment',array(
				'div'=>false,'label'=>false,
				'type'=>'button',
				'data-role'=>'button',
				'data-icon'=>'delete',
				'data-iconshadow'=>'true',
				'data-iconpos'=>'notext',
				'data-corners'=>'false',
				'class'=>'comment_hide'.$comment['Comment']['id'],
				'rel'=>'external',
				'data-ajax'=>'false'
			));	
		}
				
	}

?>
	</div><!-- comment buttons -->
			<div class="the_comment">
<?
	//	echo '<h1>placeholder</h1>';
		
		echo $comment['Comment']['diff'].$comment['Comment']['rating'].'/5 '
		.'<br />'.$comment['Comment']['thoughts'];
		
		//set height and overflow "scroll" here to prevent long-winded comments taking up more than their fair share
		echo '<div style="width:200px;clear:both"><div class="total" style="float:left">'.
		$comment['Comment']['diff'] .'</div>';
		echo '<div style="float:right;"><strong>'.$formattedname[0].'</strong> 
		rated '.$comment['Comment']['rating'].'/5 '
		.'<br/> '.$comment['Comment']['thoughts'].'</div></div>';
		

		

?>		
	</div><!-- /the_comment -->


<? 	echo $this->Form->end();  ?>
</div>
<? //in theory not all are needed if comment is flagged, but too much to worry about now ?>
<script type="text/javascript">
//<![CDATA[
//$(document).on('pagebeforeshow', function(){ don't need this here, because the page is not reloading when this happen       
$(document).off('click', '.comment_hide<? echo $comment['Comment']['id']; ?>').on('click', '.comment_hide<? echo $comment['Comment']['id']; ?>',function(e) {
	//console.log('click');
	$.ajax({
	async:true,
	data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		//$('#comments').remove();
		//$('<div id="comments"></div>').appendTo('#comments_container');
		$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
		//$('#comments_box').remove();
		//$('<div id="comments_box"></div>').appendTo('#comments_container');
		//$('#sCommentViewForm')[0].reset(); 
		//console.log(data);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_hide/<? echo $comment['Comment']['id']; ?>"});
	return false;
}); 

$(document).off('click', '.comment_up<? echo $comment['Comment']['id']; ?>').on('click', '.comment_up<? echo $comment['Comment']['id']; ?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".container<? echo $comment['Comment']['id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_up/<? echo $comment['Comment']['id']; ?>/<? echo $comment['Comment']['template_id']; ?>/1"});
	return false;
});

$(document).off('click', '.comment_down<? echo $comment['Comment']['id']; ?>').on('click', '.comment_down<? echo $comment['Comment']['id']; ?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$(".container<? echo $comment['Comment']['id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_up/<? echo $comment['Comment']['id']; ?>/<? echo $comment['Comment']['template_id']; ?>/-1"});
	return false;
});

<?
//redraw the entire comment box if flagged and there is no logged in user, otherwise just the comment itself
$flagclass='.comments'.$comment['Comment']['template_id'];
?>

//$(document).on('updatelayout', function(){
$(document).off('click', '.comment_flag<? echo $comment['Comment']['id']; ?>').on('click', '.comment_flag<? echo $comment['Comment']['id']; ?>',function(e) {
	$.ajax({
	async:true,
	data:$(".<? echo $comment['Comment']['id']; ?>CommentAddForm").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$("<? echo $flagclass; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_flag/<? echo $comment['Comment']['id'].'/'.$comment['Comment']['template_id'].'/'.$flagvalue?>"});
	return false;
});
//});

//});
//]]>
</script>