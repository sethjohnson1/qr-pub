<?
//get the images
$image=array();
foreach (glob('wgwa_slideshow_imgs/*.JPG') as $key=>$filename) $image[$key]=$filename;
//if it's lowercase...
if (empty($image)) foreach (glob('wgwa_slideshow_imgs/*.jpg') as $key=>$filename) $image[$key]=$filename;
?>
<html>
<head>
<script type="text/javascript" src="jquery.slides.min.js"></script>
<style>
body{
	background-color:black;
	
}
</style>
</head>
<body>
  <div class="container">
    <div id="slides">
	  <?foreach ($image as $k=>$img):?>
	  <img src="<?=$img?>" alt="Slideshow item #<?=$k?>" />
	  <?endforeach?>
      <!-- a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
      <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a -->
    </div>
  </div>
  
    <script>
    $(function() {
      $('#slides').slidesjs({
        width: 940,
        height: 528,
        navigation: {
			active: false,
			effect: "slide"
		},
		pagination:{
			active:false,
			effect: "slide"
		},
		play:{
			active:false,
			effect: "fade",
			interval: 5000,
			auto: true,
			restartDelay:5000,
			
		}
      });
    });
  </script>
</body>
</html>