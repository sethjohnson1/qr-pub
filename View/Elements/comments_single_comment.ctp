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

echo $this->Form->create($comment['Comment']['id']);

//see if its their own comment
if (!empty($user['id']) && $comment['Comment']['user_id']==$user['id']) $mine='mine';
else echo $this->Session->flash('commentFlash');

if (isset($comment['CommentsUser']['id'])){
	//the user has interacted with this comment, set some useful variables
	$flagged=$comment['CommentsUser']['flagged'];
	$upvoted=$comment['CommentsUser']['upvoted'];
	$downvoted=$comment['CommentsUser']['downvoted'];

	//debug($downvoted);
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
if(($flagged==true || $comment['Comment']['flags']>=4) ||
 (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']) )) $cheight=100;
else $cheight=160;


?>	
	<style type="text/css" scoped>
		.container<? echo $comment['Comment']['id'] ?>{
			//border: 2px solid green;
			//width:95%;
			height: <? echo $cheight ?>px;
		}
		.comment_buttons{
		//	border: 1px solid blue;
			width: 9%;
			max-width: 10px;
		//	min-width:50px;
			height: 150px;
			float: left;
		}
		.the_comment{
			float:left;
			height: 140px;
			width:90%;
			padding-top: 1px;
			overflow-y:auto;
		//	border: 1px solid yellow;
		}
		.comment_text{
			float:left;
			padding: 0 0 0 30px;
		}
		.starred:after{
			background-color: #bd4f19 !important;
		}
		.staricon{
			position: relative;
			padding: 12px;
		}


	</style>
		
	<?
	//debug($reveal);
	if(
		$flagged==true 
		|| ($comment['Comment']['flags']>=4 && empty($reveal))
		|| (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']))
	){
		//$hidden=true;
		
	/*
	right here is where glitch starts, $flagvalue is the problem
	*/
		if($flagged==true ||  (isset($cookie_flags[$comment['Comment']['id']]) && empty($user['id']))){
			
			$flagvalue=-1; //used later down in link
			$flaglabel='Unflag';
			echo $this->Form->input($flaglabel,array(
				'div'=>false,
				'type'=>'button',
				'label'=>false,
				'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
				'style'=>'float:left'
				));
			
			echo '<p><strong>You flagged this message as inappropriate.</strong> If you simply did not like the comment,
			please unflag using the icon and vote it down instead.</p>';
			}
		/*
			the obvious flaw here is that it reveals all the flagged comments. I am sick of 
			working on it right now and will revisit after thinking about it some more.
		*/
		else if ($comment['Comment']['flags']>=4){
			//just not so easy, commented out for now
			$flagvalue='reveal';
			//$flagvalue=-1;
			echo $this->Form->input('Reveal',array(
				'div'=>false,
				'type'=>'button',
				'label'=>false,
				'class'=>'ui-btn-icon-notext ui-mini ui-btn ui-icon-alert fsign'.' comment_flag'.$comment['Comment']['id'],
				'style'=>'float:left'
			));
			echo '<p>This comment has been flagged as inappropriate '.$comment['Comment']['flags'].' times.
			Tap the warning icon if you want to live dangerously and read it.</p>';
			
			}
	
	}
	
	else{
		//giant block to draw the comment and buttons
		?>
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
		}
		?>
		
		
	</div><!-- /comment_buttons -->
		<?
		//set height and overflow "scroll" here to prevent long-winded comments taking up more than their fair share
		?>
		<div class="the_comment">
		<!-- div style="width:200px;clear:both" -->
		<div class="total" style="float:left"><? echo $comment['Comment']['diff'] ?></div>
		
		<div class="comment_text"><strong><? echo $formattedname[0] ?></strong>
		
		<?
		for ($x=0;$x<=4; $x++):
			if ($comment['Comment']['rating'] > $x) $starred='starred';
			else $starred='';
			
		?>
		<span class="ui-icon-star ui-btn-icon-notext staricon <? echo $starred ?>"/></span>

		<?
		endfor;
		?>
		<br />
		<? echo $comment['Comment']['thoughts'] ?>
		</div>
		<!-- /div -->
		</div><!-- /the_comment -->

	<?	} //end of the else. The colon method doesn't work as well with nested IF above ?>

	

	<!-- div style="clear:both;">
	</div -->

<? 
		echo $this->Form->end(); 
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
</div><!-- /comment_container -->
<div style="clear:both;"></div>