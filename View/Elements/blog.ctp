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

<? // HTML5 scoped CSS all over ?>

 <style type="text/css" scoped>
   div[id^="attachment_"]{
		max-width: 50%;
	}


	/* =WordPress Core
-------------------------------------------------------------- 
.alignnone {
    margin: 5px 20px 20px 0;
}

.aligncenter,
div.aligncenter {
    display: block;
    margin: 5px auto 5px auto;
}

.alignright {
    float: right;
    margin: 5px 0 20px 20px;
}

.alignleft {
    float: left;
    margin: 5px 20px 20px 0;
}

.aligncenter {
    display: block;
    margin: 5px auto 5px auto;
}

a img.alignright {
    float: right;
    margin: 5px 0 20px 20px;
}

a img.alignnone {
    margin: 5px 20px 20px 0;
}

a img.alignleft {
    float: left;
    margin: 5px 20px 20px 0;
}

a img.aligncenter {
    display: block;
    margin-left: auto;
    margin-right: auto
}

.wp-caption {
    background: #fff;
    border: 1px solid #f0f0f0;
    max-width: 96%; /* Image does not overflow the content area */
    padding: 5px 3px 10px;
    text-align: center;
}

.wp-caption.alignnone {
    margin: 5px 20px 20px 0;
}
/*
sj - modified these from WordPress CSS to always center
*/
.wp-caption.alignleft {
    margin: 0 auto;
}

.wp-caption.alignright {
    margin: 0 auto;
}

/* sj modified this for images to be responsive */
.wp-caption img {
    border: 0 none;
    height: auto;
    margin: 0;
    padding: 0;
    width: 98.5%;
}

.wp-caption p.wp-caption-text {
	font-style: italic;
	margin-bottom: 1em;
}
*/
	
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
	//using strip_tags for now, someday it would be nice to make the thumbnails expand.. but...
	if (Configure::read('enableKioskMode')==1) $wp_content['asset_text']=strip_tags($wp_content['asset_text'],'<img><div><p><h3>');
	echo $wp_content['asset_text'];
?>
<script type="text/javascript">
	//<![CDATA[
	//enhance the images with JQM classes
	$( 'div[id^="attachment_"]' ).addClass( "ui-shadow ui-body ui-body-a ui-mini" );
	//style contains fixed-pixel widths, so needs to be eliminated
	$( 'div[id^="attachment_"]' ).removeAttr( 'style' );
	//]]>
</script>

</div><!-- blog_container -->
<br />
