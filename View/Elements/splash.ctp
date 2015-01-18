<div class="blog_container ui-shadow ui-body ui-body-a">
 <style type="text/css" scoped>
   .splashimg{
	max-width: 100%;
   }
   .blog_container{
		max-height:1100px;
		max-width:1100px;
		margin: 0 auto;
   }

	
</style>
<?
$asset=$template['Asset'][0];
//debug($asset);
?>
<?
echo $this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg',array(
	'alt'=>'iScout splash page',
	'class'=>'splashimg'
));
?>
</div><!-- /blogcontainer -->
<div class="ui-body ui-body-a ui-shadow">
<h3>
<? echo $asset['asset_text'] ?>
</h3>
</div>
<br />