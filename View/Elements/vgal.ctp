<? 
$treasures=array();
foreach ($template['Asset'] as $asset)
{
	if ($asset['name']=='treasure')
	{
		echo '<div data-role="popup" id="'.$template['Template']['id'].'_'.$asset['id'].'" data-overlay-theme="b" data-theme="b" data-corners="false">';
		echo 	'<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>';
		echo 	$this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg', array('alt'=>$asset['asset_text'],'id'=>'popedimg'));
		echo '</div>';
		
		//also build array here
		$treasures[$asset['sortorder']]=array('id'=>$asset['id'],'asset_text'=>$asset['asset_text'],'filename'=>$asset['filename']);
		//debug($asset['sortorder']);
	}
	if ($asset['name']=='description'){
		$description=$asset['asset_text'];
		$title=$asset['filename'];
		$author=$asset['filemime'];
		//override with vGal info
		$this->set('meta_description', $description);
		$this->set('title_for_layout', $asset['filename']);
	}

} 
	ksort($treasures);
?> <style type="text/css" scoped>
	div.vgalchild{
		//border: 1px solid red;
		height: 160px;
		width: 150px;
	}
	.caption{
		background-color:#fff;
		width:100px;
		float:left;
		padding: 5px 0 0 0;
	}
	.blog_container div.vgalchild:nth-child(5n) {
		//border: solid green 2px;
		//margin-left:10px;
		//float:right;
	}
	
  </style>
<h3 class="ui-shadow ui-bar ui-bar-a"><? echo $title ?><br/>
<span class="ui-mini">By <?echo $author?></span>
</h3>
<?
/* this is a general idea of how we'll want to do it. Maybe a 4-column makes sense but you get the idea
	also we'll probably need to set our own threshold instead of the generic "ui-responsive"
	it should be the amount of image (currently 150px) + width of caption
	http://demos.jquerymobile.com/1.3.0-beta.1/docs/content/content-grids-responsive.html
	
	err.. and this doesn't work on iPad at all
*/
?>
<div class="blog_container ui-shadow ui-body ui-body-a ui-grid-d ui-responsive">
<h2 class="ui-mini"><? echo $description ?></h2>

<? foreach ($treasures as $asset):
	//if ($asset['name']=='treasure') : ?>
<div class="vgalchild ui-shadow ui-body-a">
<?

		//debug($asset['asset_text']);
		$imageSrc = Configure::read('globalSiteURL').'/img/uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg';
		$caption = '';

		echo $this->Html->link(
		'<div class="the-objects">
			<div class="img-block" style="background-image: url(\''.$imageSrc.'\');"></div>
		</div>','#'.$template['Template']['id'].'_'.$asset['id']
		,array('escape'=>false,'data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'fade'));
		
		//currently I like the caption not a link
		if(!empty($asset['asset_text'])){
			echo '<div class="caption ui-mini">'.$asset['asset_text'].'</div>';
		}
		
		

?>
</div><!-- /vgalchild -->

<?
	//endif;
endforeach;
?>
</div><!-- /blogcontainer -->
<script type="text/javascript">
	//<![CDATA[
	//assign the JQM classes, these might need to be updated if the divs are reordered
	$( '.blog_container div.vgalchild:nth-child(5n-3)' ).addClass( "ui-block-a" );
	$( '.blog_container div.vgalchild:nth-child(5n-2)' ).addClass( "ui-block-b" );
	$( '.blog_container div.vgalchild:nth-child(5n-1)' ).addClass( "ui-block-c" );
	$( '.blog_container div.vgalchild:nth-child(5n+0)' ).addClass( "ui-block-d" );
	$( '.blog_container div.vgalchild:nth-child(5n+1)' ).addClass( "ui-block-e" );
	//]]>
</script>
<br />