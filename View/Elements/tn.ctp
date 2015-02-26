<? 
//debug($template);
$treasures=array();
foreach ($template['Asset'] as $key=>$asset)
{
	$treasures[$asset['sortorder']]=array('id'=>$asset['id'],'synopsis'=>$asset['synopsis'],'filename'=>$asset['filename']);
} 
	ksort($treasures);
?> 
<style type="text/css" scoped>
	div.vgalchild{
	//	border: 1px solid red;
		height: 160px;
		min-width: 165px;
		margin: 0 auto;
	}

  </style>

<!-- h3 class="ui-shadow ui-bar ui-bar-a"><? echo $title ?><br/>
<span class="ui-mini">By <?echo $author?></span>
</h3 -->

<div class="ui-shadow ui-bar ui-bar-a">
<h3>Tap each picture to learn more</h3>
</div>
<div class="vgal_container ui-shadow ui-body ui-body-a ui-grid-c">

<? foreach ($treasures as $key=>$asset):?>

	
	
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
		
		//the old caption - Ashley might want this!
		/*
		if(!empty($asset['asset_text'])){
			echo '<div class="caption ui-mini">'.$asset['asset_text'].'</div>';
		}
		*/
		
		

?>
</div><!-- /vgalchild -->

<?
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