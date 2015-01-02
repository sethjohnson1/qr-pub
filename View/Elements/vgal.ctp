<? 

foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
		echo '<div data-role="popup" id="'.$template['Template']['id'].'_'.$asset['id'].'" data-overlay-theme="b" data-theme="b" data-corners="false">';
		echo 	'<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
		echo 	$this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg', array('alt'=>$asset['asset_text'],'id'=>'popedimg'));
		echo '</div>';
	}
	if ($asset['name']=='description'){
		$description=$asset['asset_text'];
		$title=$asset['filename'];
		//override with vGal info
		$this->set('meta_description', $description);
		$this->set('title_for_layout', $asset['filename']);
	}
	
} //this part draws the images that link to the lightboxes above and makes desc

?>
<h3 class="ui-shadow ui-bar ui-bar-a"><? echo $title; ?></h3>
<div class="ui-shadow ui-body ui-body-a">
<? echo '<h3>'.$description.'</h3>'; ?>

<?
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
		$imageSrc = Configure::read('globalSiteURL').'/img/uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg';
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
</div>
<br />