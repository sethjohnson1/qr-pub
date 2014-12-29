<?
echo $this->element('jqm_header');
/*
this entire view assumes vgal template, make separate element for each template


*/


//debug($totals);
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
<h3>Comments</h3>

<?
if (isset($user)){
	echo $this->Form->create('sComment');
	//echo $this->Form->input('vgalid');
	if (isset($usercomment['Comment']['thoughts'])) $thoughts=$usercomment['Comment']['thoughts'];
	else $thoughts='';
	echo $this->Form->input('comment',array('type'=>'textarea','value'=>$thoughts));		
	echo $this->Form->input('rating',
		array('type'=>'range','data-highlight'=>'true','min'=>'0','max'=>'5','value'=>'3'));		
	echo $this->Form->input('Add',array('type'=>'button','id'=>'comment_add','label'=>false));	
	
	//echo $this->Form->submit('Submit');
	echo $this->Form->end(); 

	$data = $this->Js->get('#sCommentViewForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#comment_add')->event(
        'click', $this->Js->request(
            array('controller' => 'commentsUsers', 'action' => 'comment_add',$id), array(
				'update' => '#comments',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
 }
 else {
	$loginlink = $this->Html->link('Login is simple.','#userPopup',array('data-rel'=>'popup','data-position-to'=>'window'));
	echo 'Join in! '.$loginlink.'<br />';
	}
?>


	<div id="comments" style="border: solid black; padding: 12px 12px 12px 12px">
		<? 
		if(empty($user))$user='';
		echo $this->element('commentswidget',array($comments,$user));?>
	</div>
</div>
<?
echo $this->element('jqm_footer');
?>