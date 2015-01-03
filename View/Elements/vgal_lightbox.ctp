<? 
foreach ($template['Asset'] as $key=>$asset):
	if ($asset['name']=='treasure'):
	//straight out of JQM docs for prerendered popups
?>
	<div id="pre-rendered-screen<? echo $key ?>" class="ui-popup-screen ui-screen-hidden"></div>
		<div id="pre-rendered-popup<? echo $key ?>" class="ui-popup-container fade ui-popup-hidden ui-body-inherit ui-overlay-shadow ui-corner-all">

			<div data-role="popup" class="poppedimg ui-popup" id="<? echo $template['Template']['id'].'_'.$asset['id']?>" 
			data-overlay-theme="b" data-theme="b" data-corners="false" data-enhanced="true" data-transition="fade">
		
				<a href="#" data-rel="back" data-theme="e" class="ui-btn ui-corner-all ui-shadow ui-btn-e ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
				<?
				echo $this->Html->image('uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg', array('alt'=>$asset['asset_text'],'id'=>'poppedimg'));
				?>
			<br />
			<p class="ui-shadow ui-bar ui-bar-a">
				<? echo $asset['asset_text']; ?>
			</p>
		<?
		/* after some testing, the iPad requires both target blank (back button doesn't work otherwise)
		and also rel external - otherwise neither would be required and we'd simply go to the img via link */
		echo $this->Html->link('Open Full Size Image','/img/uploads/'.$template['Template']['id'].'_'.$asset['filename'].'.jpg',array(
		'rel'=>'external','target'=>'_blank','class'=>'ui-mini'));?>
		</div><!-- /popup -->
		</div><!-- pre-rendered -->
<?
	endif;
endforeach;
?>