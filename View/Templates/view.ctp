<?
if($this->layout = 'mobile') 
	require_once(APP . 'Vendor' . DS.'jqm/header.php');
//resason to refrence the file this way was given by a cakephp contributer here, 
//look for him trolling a commenter saying its not mentioned in the cookbook  because they need help with documenting
//http://stackoverflow.com/questions/8158129/loading-vendor-files-in-cakephp-2-0

// the following draws all the hidden lightbox
foreach ($template['Asset'] as $asset){
	if ($asset['name']=='treasure'){
		echo '<div data-role="popup" id="'.$template['Template']['id'].'_'.$asset['id'].'" data-overlay-theme="b" data-theme="b" data-corners="false">';
		echo 	'<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
		echo 	$this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg', array('alt'=>$asset['asset_text']));
		echo '</div>';
	}}?>
<div id="positiontehbox">&nbsp;</div>
<? //this part draws the images that link to the lightboxes above
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
		$imageSrc = 'http://172.16.144.30/qr-pub/img/uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg';
		$caption = 'this is the caption';
		echo $this->Html->link(
		'<div class="the-objects">
			<div class="img-block" style="background-image: url(\''.$imageSrc.'\');"></div>
			<div class="caption">'.$caption.'</div>
		</div>','#'.$template['Template']['id'].'_'.$asset['id']
		,array('escape'=>false,'data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'fade'));	
	}
}
?>


<div class="commenting">
<?
//begin disqus work...
	echo $this->Form->create('dComment');
	//echo $this->Form->input('vgalid');
	echo $this->Form->input('comment',array('id'=>'jsoncomment','type'=>'textarea'));	
	//echo $this->Form->input('response',array('id'=>'response','type'=>'textarea'));	
	echo $this->Form->input('Ajax the mofo',array('type'=>'button','id'=>'commentbutton','label'=>false));	
	echo $this->Form->input('url',array('value'=>"http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'type'=>'hidden'));
	//echo $this->Form->submit('Submit');
	echo $this->Form->end(); 
	
	$data = $this->Js->get('#dCommentViewForm')->serializeForm(array('isForm' => true, 'inline' => true));
	$this->Js->get('#commentbutton')->event(
        'click', $this->Js->request(
            array('controller' => 'templates', 'action' => 'commentbutton'), array(
				'update' => '#response',
				'async' => true,
				'data'=>$data,
				'dataExpression'=>true,
				'method'=>'POST'
                )
            )
    );
    
	echo $this->Js->writeBuffer();
	?>
	<div id="response" style="height: 300px; width:500px; border: solid black; padding: 12px 12px 12px 12px"></div>
</div>
<?
if($this->layout = 'mobile') 
	require_once(APP . 'Vendor' . DS.'jqm/footer.php');
//resason to refrence the file this way was given by a cakephp contributer here, 
//look for him trolling a commenter saying its not mentioned in the cookbook  because they need help with documenting
//http://stackoverflow.com/questions/8158129/loading-vendor-files-in-cakephp-2-0
?>
