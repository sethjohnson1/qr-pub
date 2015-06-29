<h1>
Tell us what YOU think happened to this gun!<br />
Leave a comment after the video or tap the arrow to skip it
</h1>

<video onclick="playPause()" id="rifle" style="width:100%;" poster="<?=$this->webroot?>/img/lost_gun_overlay.jpg">
  <source src="<?=Configure::read('globalSiteURL').'vid/rifle.mp4'?>" poster="lostgun.jpg" type="video/mp4">
Your browser does not support the video tag.
</video>

<?

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