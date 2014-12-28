<?
echo $this->element('CodePopUp'); 
echo $this->element('Scorecard',array($totals)); 
echo $this->element('jqm_header');

//debug($totals);
// the following draws all the hidden lightbox
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
		echo '<div data-role="popup" id="'.$template['Template']['id'].'_'.$asset['id'].'" data-overlay-theme="b" data-theme="b" data-corners="false">';
		echo 	'<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
		echo 	$this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg', array('alt'=>$asset['asset_text'],'id'=>'popedimg'));
		echo '</div>';
	}
} //this part draws the images that link to the lightboxes above
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
	//if this can't be a conventional call the URL should be a global variable in private.php
		$imageSrc = 'http://ngin/qr-pub/img/uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg';
		$caption = '';
		if(!empty($asset['asset_text']))
			$caption = '<div class="caption">'.$asset['asset_text'].'</div>';
		echo $this->Html->link(
		'<div class="the-objects">
			<div class="img-block" style="background-image: url(\''.$imageSrc.'\');"></div>
			'.$caption.'
		</div>','#'.$template['Template']['id'].'_'.$asset['id']
		,array('escape'=>false,'data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'fade'));	
	}
}
?>
<div data-role="popup" id="comments"><?
if (isset($user)){
	echo $this->Form->create('sComment');
	//echo $this->Form->input('vgalid');
	if (isset($usercomments['Comment']['thoughts'])) $thoughts=$usercomments['Comment']['thoughts'];
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
	echo 'you must login to comment<br>';
 	echo $this->Html->link('FBAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Facebook'),array('rel'=>'external')).'<br>'; 
	echo $this->Html->link('GAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Google'),array('rel'=>'external')).'<br>'; 
	echo $this->Html->link('TAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Twitter'),array('rel'=>'external')).'<br>'; 
	echo $this->Html->link('DAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'dummyAuth')).'<br>'; }
 
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