<?
//debug($template);
/*
name (title
filename (YoutubeID)
daterange
synopsis
*/
?>
<div class="blog_container ui-shadow ui-body ui-body-a">
 <style type="text/css" scoped>

	.video-container {
		position: relative;
		padding-bottom: 56.25%;
		padding-top: 30px; 
		height: 100px;
		overflow: hidden;
	}
	
	.youtube_container{
		float: left;
		max-width: 50%;
		min-width: 300px;
		padding: 0 20px 0 0;
	}
	
	.text_container{
		padding: 0 0 3px 20px;
	}
 
	.video-container iframe,
	.video-container object,
	.video-container embed {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}


	
</style>
<? $asset=$template['Asset'][0]; ?>
<div class="youtube_container">
	<div class="video-container">
  <iframe class="youtube_frame" src="http://www.youtube.com/embed/<? echo $asset['filename'].'?rel=0&modestbranding=1' ?>"
   frameborder="0" allowfullscreen></iframe>
   </div>
</div><!-- /ag_container -->
<div class="text_container">
<p><strong>Title:</strong> <?=$asset['name']?></p>
<p><strong>Date:</strong> <?=$asset['daterange']?></p>
<p><strong>Synopsis:</strong> <?=$asset['synopsis']?></p>
</div>
</div><!-- /blogcontainer -->
<div class="ui-body ui-body-a ui-shadow">
<h3>
<?
	echo $asset['asset_text'];
?>
</h3>
</div>
<br />