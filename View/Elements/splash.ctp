<div class="splash_container ui-shadow ui-body ui-body-a">
 <style type="text/css" scoped>
   .splashimg_container{
	max-width: 600px;
	margin: 0 auto; 
   }
   /*
   margin-left makes it align with the bar on the logo
   */
   .splashimg{
		max-width: 100%;
		margin-left: 2%;
   }
   .splash_container{
		max-height:1100px;
		max-width:1100px;
		margin: 0 auto;
   }

	
</style>
<?
$asset=$template['Asset'][0];
//debug($asset);
?>
<div class="splashimg_container">
<?
echo $this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg',array(
	'alt'=>'iScout splash page',
	'class'=>'splashimg'
));
?>
</div>
</div><!-- /blogcontainer -->
<div class="ui-body ui-body-a ui-shadow">
<h3>
<? echo $asset['asset_text'] ?>
</h3>
</div>
<br />