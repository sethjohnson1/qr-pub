<div class="blog_container ui-shadow ui-body ui-body-a">
 <style type="text/css" scoped>

   .video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
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
	<div class="video-container">
  <iframe class="youtube_frame" src="http://www.youtube.com/embed/<? echo $asset['name'] ?>"
   width="560" height="315" frameborder="0" allowfullscreen></iframe>
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