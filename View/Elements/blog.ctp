<?
//debug($template);
foreach ($template['Asset'] as $asset){
	if ($asset['name']=='id') $wpid=$asset['asset_text'];
	if ($asset['name']=='content') $wp_content=$asset;
	if ($asset['name']=='title') $wp_title=$asset;

	if ($asset['name']=='image'){
		$wp_img[$asset['id']]=array(
			'asset_text'=>$asset['asset_text'],
			'filename'=>$asset['filename']
		);
	}

}
?>

<h3 class="ui-shadow ui-bar ui-bar-a"><? echo $wp_title['asset_text']; ?></h3>
<div class="ui-shadow ui-body ui-body-a blog_container">
<? // example of how CSS could be applied ?>
 <style type="text/css" scoped>
    div[id^="attachment_"]{
		border: solid green 4px;
		float: left;
		padding: 5px;
	}
	
  </style>
  
<? 
	//the desc might be somewhere in the API call not saved, moving on for now..
	$this->set('meta_description', $wp_title['asset_text'] );
	$this->set('title_for_layout', $wp_title['asset_text']); 
	foreach($wp_img as $img){
		//debug($img);
	}
	echo $wp_content['asset_text'];

?>
</div><!-- blog_container -->
<br />
