<h1>
Tell us what YOU think happened to this gun!<br />
Leave a comment after the video or tap the blue arrow to skip it
</h1>
<video onclick="playPause()" id="rifle" style="width:100%;">
  <source src="<?=Configure::read('globalSiteURL').'vid/rifle.mp4'?>" type="video/mp4">

Your browser does not support the video tag.
</video>
<!-- button onclick="playPause()">Play/Pause</button --> 
<?
/*
found this on SO, looks promising but not tested at all

<video width="320" height="240">
  <source src="movie.mp4" type="video/mp4">
</video>
<script>
  $(document).ready(function(){
    $('video').on('ended',function(){
      console.log('Video has ended!');
    });
  });
</script>
*/

?>

<script> 
var myVideo = document.getElementById("rifle"); 

function playPause() { 
    if (myVideo.paused) 
        myVideo.play(); 
    else 
        myVideo.pause(); 
} 

  $(document).ready(function(){
    $('#rifle').on('ended',function(){
	setTimeout(function(){$( "#lost_gun_next" ).click()},1000);
    });
  });

</script> 

		<?
			if (isset($template['Template']['nextid'])) echo $this->Html->link('',array('controller'=>'templates','action'=>'view',$template['Template']['nextid'],'?'=>array('next'=>1)),array('data-role'=>'button','data-prefetch'=>true,'data-transition'=>'slide','id'=>'lost_gun_next'));
	?>