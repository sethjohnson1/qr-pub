<?
//need to use TITLE here!
?>
<h3 class="ui-bar ui-bar-a">From the Vaults...</h3>
<div class="ui-body ui-body-a">
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
	}
	
} //this part draws the images that link to the lightboxes above and makes desc
?>

<? echo '<h3>'.$description.'</h3>'; ?>

<?
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
	//if this can't be a conventional call the URL should be a global variable in private.php
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