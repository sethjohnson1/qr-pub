<?
//echo $this->element('Scorecard',array($totals)); 
echo $this->element('CodePopUp'); 
echo $this->element('userPopup'); 
echo $this->element('global_menu');
?>
<?
echo '<div data-role="page" id="qrpage'.$template['Template']['id'].'" data-theme="a">';

?>
	<div data-role="header" data-position="fixed" style="border-bottom:9px solid #aa9c8f;background-color:#fff;">
		<div class="ui-block-a"><h1 style="margin:0px 0px 0px 10px;padding: 0px;z-index: 100;position:relative;
		top: 19px; float:left">
		<? 
		echo $this->Html->image('mobile-logo.png',array(
			'url'=>'/',
			'height'=>'78',
			'width'=>'150',
			//'style'=>'height: 100px;',
			'alt'=>'Center of the West logo',
			'class'=>'goaway'
			
			));
		?>
		</h1></div>
		<div class="ui-block-b">&nbsp;</div>
		<div class="ui-block-c">&nbsp;</div>
		<div class="ui-block-d">&nbsp;</div>
		<div class="ui-block-e">
			<div class="ui-btn-right ui-grid-a">
				<div align="center">
				<? 
				$btnstyle='margin:0px;border-left:none;padding:0 27px 0 0;';
				if (isset($user['provider'])){
				
					if ($user['provider']=='email'){
						$datatheme='e';
						$dataicon='mail';
					}
					if ($user['provider']=='Facebook'){
						$datatheme='b';
						$dataicon='heart';
					}
					if ($user['provider']=='Google'){
						$datatheme='c';
						$dataicon='plus';
					}
					if ($user['provider']=='Twitter'){
						$datatheme='d';
						$dataicon='comment';
					}
				}
				else {
					$datatheme='a';
					$dataicon='user';
				}
				echo $this->Html->link('Login','#userPopup',array(
					'data-role'=>'button',
					'data-rel'=>'popup',
					//change this based on provider 
					'data-theme'=>$datatheme,
					'data-icon'=>$dataicon,
					'data-iconshadow'=>'true',
					'data-iconpos'=>'notext',
					'data-corners'=>'false',
					'data-transition'=>'pop',
					//doesn't work on iPad
					//'data-transition'=>'turn',
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
					'data-transition'=>'pop',
					'data-position-to'=>'window',
					'style'=>$btnstyle
					
				));
				?>
				
				</div>
				
				<div class="ui-block-solo">
				<?
				echo $this->Html->link('Enter Code','#CodePopUp',array(
				'data-role'=>'button','data-rel'=>'popup','data-position-to'=>'window',
				'data-transition'=>'pop','style'=>'width:90px;padding:10px 10px 10px 10px;'
				));?>
				</div>
				
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>