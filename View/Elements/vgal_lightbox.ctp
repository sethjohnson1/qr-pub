<style type="text/css" scoped>
	div.imgpopup_container{
		width: 180px ;
		margin: 0 auto;
	}
	img.vgal_poppedimg{
		max-width: 100%;
		margin: 0 auto;
	}
	div.vgal_details{
		padding: 0 0 0 10px;
	}

	div[id^="popupcontainer_"]{
		overflow-y: auto;	
	}

</style>
<?
//this is done similar elsewhere and should be consolidated later
foreach ($template['Asset'] as $key=>$asset):
	if ($asset['name']=='treasure'):

	//straight out of JQM docs for prerendered popups
?>
	<div id="pre-rendered-screen_<? echo $key ?>" class="ui-popup-screen ui-overlay-a ui-screen-hidden"></div>
		<div id="pre-rendered-popup_<? echo $key ?>" 
		class="ui-popup-container pop ui-popup-hidden ui-body-inherit  ui-corner-all">

			<div data-role="popup" class="poppedimg ui-popup ui-overlay-shadow " id="<? echo $template['Template']['id'].'_'.$asset['id']?>" 
			data-enhanced="true" data-overlay-theme="a">
			
			<a href="#" data-rel="back" data-theme="e" class="ui-btn ui-corner-all ui-shadow ui-btn-e ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
			
		<div  id="popupcontainer_<? echo $key ?>" class="vgalpopup_container ui-shadow ui-body ui-body-a ui-corner-all">
			<div class="popup_quasi_header_bar">
			
			<p class="ui-shadow ui-bar ui-bar-a">
				<? echo $asset['asset_text']; ?>
			</p>
			</div>
			<div class="ui-shadow vgal_details">
			
			<? 
			//this is crude for now, for some fields, then the picture, then the rest
			
			if (isset($asset['objtitle'])){
				echo '<p><strong>Title: </strong>'
					.$asset['objtitle'].'</p>';
			}
			if (isset($asset['daterange'])){
				echo '<p><strong>Date info: </strong>'
					.$asset['daterange'].'</p>';
			}
			if (isset($asset['gloss'])){
				echo '<p><strong>Gloss: </strong>'
					.$asset['gloss'].'</p>';
			}
			if (isset($asset['remarks'])){
				echo '<p><strong>Remarks: </strong>'
					.$asset['remarks'].'</p>';
			}
			if (isset($asset['commonname'])){
				echo '<p><strong>Common Name: </strong>'
					.$asset['commonname'].'</p>';
			}
			if (isset($asset['genus'])){
				echo '<p><strong>Genus: </strong>'
					.$asset['genus'].'</p>';
			}
			
			//Only close the div and do the image if its a vgal, otherwise skip it
			if ($template['Template']['name']=='vgal') :
			?>
			
			</div>
			<div class="imgpopup_container ui-shadow ui-body ui-body-a">
			<?
				echo $this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['id'].'.jpg', array(
				'alt'=>$asset['asset_text'],'class'=>'vgal_poppedimg'
				));
				?>
			<br />

		<?
		/* after some testing, the iPad requires both target blank (back button doesn't work otherwise)
		and also rel external - otherwise neither would be required and we'd simply go to the img via link */
		echo $this->Html->link('Open Full Size Image','/img/uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg',array(
		'rel'=>'external','target'=>'_blank','class'=>'ui-mini'));?>
			</div><!-- imgpop_container -->
			<div class="ui-shadow vgal_details">
			
			<? 
			endif;
			if (isset($asset['insrciption'])){
				echo '<p><strong>Inscription: </strong>'
					.$asset['insciption'].'</p>';
			}
			if (isset($asset['dimensions'])){
				echo '<p><strong>Dimensions: </strong>'
					.$asset['dimensions'].'</p>';
			}
			if (isset($asset['accnum'])){
				echo '<p><strong>Accession Number: </strong>'
					.$asset['accnum'].'</p>';
			}
			if (isset($asset['synopsis'])){
				echo '<p style="padding-bottom:20px"><strong>Synopsis: </strong>'
					.$asset['synopsis'].'</p>';
			}
			
			?>

			</div>
		</div><!-- /vgal popcontainer -->
		</div><!-- /popup -->
		<!-- div data-role="footer" data-position="fixed" >
			<h1>I am a footer that does not work right on iOS</h1>
		</div -->
		</div><!-- pre-rendered -->

<?
	endif;
endforeach;
?>