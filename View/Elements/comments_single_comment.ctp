<div class="container<? echo $comment['Comment']['id'] ?>" >
<?

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
else $formattedname[0]='SethTest';

echo $this->Form->create($comment['Comment']['id'],array('class'=>'comment'.$comment['Comment']['id']));

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
//someday this could be combined a little, this is one Meal of an IF statement and is used Twice!
/*if(($flagged==true || $comment['Comment']['flags']>=4) ||
 (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']) )) $cheight=100;
else 
*/

$cheight=160;


?>	
	<style type="text/css" scoped>
		.container<?=$comment['Comment']['id'] ?>{
			height: <?=$cheight ?>px;
		}
		.comment_buttons{
			width: 9%;
			max-width: 10px;
			padding: 0 0 0 4px;
			height: 140px;
			float: left;
		}
		.the_comment{
			float:left;
			height: 173px;
			width:90%;
			padding-top: 1px;
			overflow-y:auto;
			border: 1px dashed #ede9e7;
			border-right:none;
		}
		.comment_text{
			
			padding: 16px 0px 0px 53px;
		}
		.starred:after{
			background-color: #bd4f19 !important;
		}
		.staricon{
			position: relative;
			padding: 12px;
		}
		.comment_destructive{
			width:60px;
			padding-top:2px;	
			float:right;
		}		
		.comment_header{
		width:100%;	
		}
		.comment_thoughts{
			width:85%;
			overflow-y:auto;
			max-height:150px;
		}
		div.total{
			background-color: rgba(246, 246, 246, .5);
			border: 1px solid rgb(221, 221, 221);
			position: relative;
			display: block;
			width: 11px;
			height: 15px;
			top: 0px;
			box-shadow: 0 1px 0 rgba(255,255,255,.4);
			font-size:.75em;
			left:0px;
			font-weight:bold;			
			
			
		}
		div.votes div{
			background-color: rgba(246, 246, 246, .75);
			border: 1px solid rgb(221, 221, 221);
			box-shadow: 0 1px 0 rgba(255,255,255,.4);
			position: relative;
			left: 20px;
			top: -20px;
			z-index:99 !important;
			font-size: .75em;
			border-radius: 25px;	
			padding: 3px 12px 0px 6px;
		}
		div.votes{
			height:42px;
		}
		div.upvote{
			color:#035642;
		}
		div.downvote{
			color:#981e32;
		}
		span.diff{
			margin-left:-9px;
		}
		
		
	</style>
		<div style="clear:both">&nbsp;</div>
	<?

	if($flagged==true ||  (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']))){
		
			$flaglabel='Unflag';
			echo $this->Form->input($flaglabel,array(
				'div'=>false,
				'type'=>'button',
				'label'=>false,
				'class'=>'ui-btn-icon-notext ui-mini ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
				'style'=>'float:left'
				));
			
			echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'unflag'));
			echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment,
			please unflag and vote it down instead.</p>';
	}
	else if ($comment['Comment']['flags']>=4 && !isset($reveal)){
	
		echo $this->Form->input('Reveal',array(
			'div'=>false,
			'type'=>'button',
			'label'=>false,
			'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
			'style'=>'float:left'
			));
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'reveal'));
		echo '<p>This comment has been flagged as inappropriate '.$comment['Comment']['flags'].' times.
			Tap the warning icon if you want to live dangerously and read it.</p>';
		
	}
	
	else{
		//giant block to draw the comment and buttons
		?>
		

		<div class="the_comment">
		
		<div class="comment_buttons">
		<div class="votes">
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
		));?>
		<div class="upvote"><?=$comment['Comment']['upvotes']?></div>
		</div>
		<?
		//color the total..
		$voteclass='';
		if ($comment['Comment']['diff'] > 0) $voteclass='upvote';
		if ($comment['Comment']['diff'] < 0) $voteclass='downvote';
		?>
		<div class="total <?=$voteclass?>"><span class="diff"><?=$comment['Comment']['diff'] ?></span></div>
		<div class="votes" >
		
		<? echo $this->Form->input('DownVote',array(
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
		?>
		
		<div class="downvote"><?=$comment['Comment']['downvotes'] ?></div>
		</div>
		<div class="votes">
		<?	echo $this->Form->input($flaglabel,array(
			'div'=>false,
			'label'=>false,
			'type'=>'button',
			'data-role'=>'button',
			'data-icon'=>'alert',
			'data-iconshadow'=>'true',
			'data-iconpos'=>'notext',
			'data-corners'=>'false',
			'class'=>'delbtn comment_flag'.$comment['Comment']['id']
		));
		echo $this->Form->input('pflag',array('type'=>'hidden','value'=>'flag'));
		?>
		</div>
		
	</div><!-- /comment_buttons -->

		<div class="comment_text">
		<div class="comment_header">
		<div class="comment_rate">
				<strong><?=$formattedname[0] ?></strong>
		
		
		<?
		for ($x=0;$x<=4; $x++):
			if ($comment['Comment']['rating'] > $x) $starred='starred';
			else $starred='';
			
		?>
		<span class="ui-icon-star ui-btn-icon-notext staricon <? echo $starred ?>"/></span>

		<?
		endfor;
		?>
		
		</div>
		<div class="comment_destructive"><?


		
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
				'data-ajax'=>'false',
				'style'=>''
				
			));
		}
		?> </div>
		</div>
		
		

		<div class="comment_thoughts"><? echo $comment['Comment']['thoughts'] ?></div>
		</div>
		<!-- /div -->
		</div><!-- /the_comment -->

	<?	} //end of the else. The colon method doesn't work as well with nested IF above ?>

	

	<!-- div style="clear:both;">
	</div -->

<? 		echo $this->Form->input('flagvalue',array('type'=>'hidden','value'=>$flagvalue));
		echo $this->Form->end(); 
		//debug($comment);
 ?>

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
		$(".comments<? echo $comment['Comment']['template_id']; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
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
		$(".container<? echo $comment['Comment']['id']  ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
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
		$(".container<? echo $comment['Comment']['id'] ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_up/<? echo $comment['Comment']['id']; ?>/<? echo $comment['Comment']['template_id']; ?>/-1"});
	return false;
});

<?
//redraw the entire comment box if flagged and there is no logged in user, otherwise just the comment itself
//if (isset($user['id'])) 
$flagclass='.container'.$comment['Comment']['id'];
//else 
//$flagclass='.comments'.$comment['Comment']['template_id'];
?>

//$(document).on('updatelayout', function(){
$(document).off('click', '.comment_flag<? echo $comment['Comment']['id']; ?>').on('click', '.comment_flag<? echo $comment['Comment']['id']; ?>',function(e) {
	$.ajax({
	async:true,
	data:$(".comment<? echo $comment['Comment']['id']; ?>").serialize(),
	dataType:"html",
	success:function (data, textStatus) {
		$("<? echo $flagclass; ?>").fadeOut(0).html(data).trigger('create').fadeIn(500);
	},
	type:"POST",
	url:"<? echo Configure::read('globalSiteURL'); ?>/commentsUsers/comment_flag/<?=$comment['Comment']['id']?>"});
	return false;
});
//});

//});
//]]>
</script>
</div><!-- /comment_container -->
