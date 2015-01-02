<?
//debug($template);
foreach ($template['Asset'] as $asset){
	if ($asset['name']=='author') $author=$asset['asset_text'];
	if ($asset['name']=='content') $wp_content=$asset;
	if ($asset['name']=='title') $wp_title=$asset;

	if ($asset['name']=='image'){
		$wp_img[$asset['id']]=array(
			'asset_text'=>$asset['asset_text'],
			'filename'=>$asset['filename']
		);
	}

}
//debug($wp_content);
?>

<? // magical CSS ?>

 <style type="text/css" scoped>
   div[id^="attachment_"]{
		float: left;
		padding: 5px;
		margin: 10px 10px;
		
	}

	.blog_container div:nth-child(odd) {
		margin-left:10px;
		float:right;
	}
	
  </style>
<h3 class="ui-shadow ui-bar ui-bar-a"><? echo $wp_title['asset_text']; ?><br/>
<span class="ui-mini">By <?echo $author?></span>
</h3>
<div class="ui-shadow ui-body ui-body-a blog_container">

  
<? 
	//the desc might be somewhere in the API call not saved, moving on for now..
	$this->set('meta_description', $wp_title['asset_text'] );
	$this->set('title_for_layout', $wp_title['asset_text']); 
	foreach($wp_img as $img){
		//debug($img);
	}
	echo $wp_content['asset_text'];
?>
<script type="text/javascript">
	//<![CDATA[
	//enhance the images with JQM classes
	$( 'div[id^="attachment_"]' ).addClass( "ui-shadow ui-body ui-body-a ui-mini" );
	//]]>
</script>

</div><!-- blog_container -->
<br />
