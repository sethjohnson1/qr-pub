<? 
//debug($template);
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='image') $wp_img=$asset;
	if ($asset['name']=='content') $wp_content=$asset;
	if ($asset['name']=='title') $wp_title=$asset;
}
	//the desc might be somewhere in the API call not saved, moving on for now..
	$this->set('meta_description', $wp_title['asset_text'] );
	$this->set('title_for_layout', $wp_title['asset_text']); 
	echo $wp_content['asset_text'];

?>
