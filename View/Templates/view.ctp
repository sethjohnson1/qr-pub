<?
echo $this->element('jqm_header',$template);

//debug($template);
if ($template['Template']['name']=='vgal') echo $this->element('vgal',array($template));
?>
<!-- div data-role="popup" id="comments" -->
<?
/* the popup is probably a bad idea, best to just add the comments at the end
basic styling here needs work

*/
?>
<div id="comments_container" style="clear:both;">
<? debug($this->element('commentsbox',array($user,$comments,$usercomment)));?>
<div id="comments_box">
<? echo $this->element('commentsbox',array($user,$comments,$usercomment)); ?>
</div>
	<div id="comments" style="border: solid black; padding: 12px 12px 12px 12px">

		<? 
		//debug($template);
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>

	</div>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).on('pagebeforeshow', function(){       
    $(document).off('click', '#comment_add').on('click', '#comment_add',function(e) {
		$.ajax({
		async:true,
		data:$("#sCommentViewForm").serialize(),
		dataType:"html",
		success:function (data, textStatus) {
			//$('#comments').remove();
			//$('<div id="comments"></div>').appendTo('#comments_container');
			$("#comments").html(data).trigger('create');
			//$('#comments_box').remove();
			//$('<div id="comments_box"></div>').appendTo('#comments_container');
			$('#sCommentViewForm')[0].reset(); 
			console.log(data);
		},
		type:"POST",
		url:"http://zsj.bbhclan.org/qr-pub/commentsUsers/comment_add/<? echo $template['Template']['id']; ?>"});
		return false;
    }); 
});
//]]>
</script>
<?
echo $this->element('jqm_footer');
?>