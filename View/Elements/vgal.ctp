<? 
$treasures=array();
foreach ($template['Asset'] as $key=>$asset)
{
	//all of the lightbox has been completely redone and can be seen at vgal_lightbox element
	//it is echoed in the footer, otherwise all those big images had to load FIRST
	if ($asset['name']=='treasure'){
		if (isset($asset['sortorder']))
			$treasures[$asset['sortorder']]=array('id'=>$asset['id'],'asset_text'=>$asset['asset_text'],'filename'=>$asset['filename']);
		else
		$treasures[$key]=array('id'=>$asset['id'],'asset_text'=>$asset['asset_text'],'filename'=>$asset['filename']);
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
/* this is a general idea of how we'll want to do it. after some messing it seems fine, but we can
always set our own width instead of the generic "ui-responsive"

	http://demos.jquerymobile.com/1.3.0-beta.1/docs/content/content-grids-responsive.html
	
	the min-width is necessary for iPad, the total of the image + caption + padding
*/
?> 
<style type="text/css" scoped>
	div.vgalchild{
	//	border: 1px solid red;
		height: 160px;
		min-width: 165px;
		margin: 0 auto;
	}

  </style>

<h3 class="ui-shadow ui-bar ui-bar-a"><? echo $title ?><br/>
<span class="ui-mini">By <?echo $author?></span>
</h3>

<div class="ui-shadow ui-bar ui-bar-a">
<h3>Tap each picture to learn more</h3>
</div>
<div class="vgal_container ui-shadow ui-body ui-body-a ui-grid-c">
<h2 class="ui-mini"><? echo $description ?></h2>

<? foreach ($treasures as $key=>$asset):

	//if ($asset['name']=='treasure') : ?>

	
	
<div class="vgalchild ui-shadow ui-body-a" >
<?

		//debug($asset['asset_text']);
		$imageSrc = Configure::read('globalSiteURL').'/img/uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg';
		$caption = '';

		echo $this->Html->link(
		'<div class="the-objects">
			<div class="img-block" style="background-image: url(\''.$imageSrc.'\');"></div>
		</div>','#'.$template['Template']['id'].'_'.$asset['id']
		,array('escape'=>false,'data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'pop'));
		
		//the old caption
		/*
		if(!empty($asset['asset_text'])){
			echo '<div class="caption ui-mini">'.$asset['asset_text'].'</div>';
		}
		*/
		
		

?>
</div><!-- /vgalchild -->

<?
	//endif;
endforeach;
?>
</div><!-- /vgal_container -->
<script type="text/javascript">
	//<![CDATA[
	//assign the JQM classes, these might need to be updated if the divs are reordered
	$( '.vgal_container div.vgalchild:nth-child(4n-2)' ).addClass( "ui-block-a" );
	$( '.vgal_container div.vgalchild:nth-child(4n-1)' ).addClass( "ui-block-b" );
	$( '.vgal_container div.vgalchild:nth-child(4n)' ).addClass( "ui-block-c" );
	$( '.vgal_container div.vgalchild:nth-child(4n+1)' ).addClass( "ui-block-d" );
	/* for five
	$( '.blog_container div.vgalchild:nth-child(5n-3)' ).addClass( "ui-block-a" );
	$( '.blog_container div.vgalchild:nth-child(5n-2)' ).addClass( "ui-block-b" );
	$( '.blog_container div.vgalchild:nth-child(5n-1)' ).addClass( "ui-block-c" );
	$( '.blog_container div.vgalchild:nth-child(5n+0)' ).addClass( "ui-block-d" );
	$( '.blog_container div.vgalchild:nth-child(5n+1)' ).addClass( "ui-block-e" );
	*/
	//]]>
</script>
<br />