<?
//echo $this->element('Scorecard',array($totals)); 
echo $this->element('CodePopUp'); 
echo $this->element('userPopup'); 
echo $this->element('global_menu');
?>
<?
echo '<div data-role="page" id="qrpage'.$template['Template']['id'].'" data-theme="a">';

?>
	<div data-role="header" data-position="fixed" style="border-bottom:9px solid #6E3219;background-color:#fff;">
		<div class="ui-block-a"><h1 style="margin:0px 0px 0px 10px;padding: 0px;z-index: 100;position: relative;top: 19px; float:left"><? echo $this->Html->image('mobile-logo.png', array('url' => array('controller'=>'internships','action'=>'index')));?></h1></div>
		<div class="ui-block-b">&nbsp;</div>
		<div class="ui-block-c">&nbsp;</div>
		<div class="ui-block-d">&nbsp;</div>
		<div class="ui-block-e">
			<div class="ui-btn-right ui-grid-a">
				<div align="center">
				<? 
				$btnstyle='margin:0px;border-left:none;padding:0 27px 0 0;';
				echo $this->Html->link('Login','#userPopup',array(
					'data-role'=>'button',
					'data-rel'=>'popup',
					//change this based on provider 
					'data-theme'=>'a',
					'data-icon'=>'user',
					'data-iconshadow'=>'true',
					'data-iconpos'=>'notext',
					'data-corners'=>'false',
					'data-transition'=>'turn',
					'data-position-to'=>'window',
					'style'=>$btnstyle
					
				));
				
				echo $this->Html->link('Menu','#menu',array(
					'data-role'=>'button',
					'data-rel'=>'popup',
					'data-icon'=>'bars',
					'data-iconshadow'=>'true',
					'data-iconpos'=>'notext',
					'data-corners'=>'false',
					'data-transition'=>'turn',
					'data-position-to'=>'window',
					'style'=>$btnstyle
					
				));
				?>
				
				</div>
				
				<div class="ui-block-solo">
				<?
				echo $this->Html->link('Enter Code','#CodePopUp',array(
				'data-role'=>'button','data-rel'=>'popup','data-position-to'=>'window',
				'data-transition'=>'turn','style'=>'width:90px;padding:10px 10px 10px 10px;'
				));?>
				</div>
				
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>