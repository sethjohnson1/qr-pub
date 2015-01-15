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
						$datatheme='';
						$dataicon='iscout-fbicon';
						
					}
					if ($user['provider']=='Google'){
						$datatheme='';
						$dataicon='iscout-googleplusicon';
						
					}
					if ($user['provider']=='Twitter'){
						$datatheme='';
						$dataicon='iscout-twittericon';
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
				
				<div class="ui-block-solo ui-field-contain">
					<? 
					echo $this->Form->create('Code',array(
						'data-ajax'=>'false',
						'id'=>'CodeForm',
						'class'=>'CodeForm',
						'div'=>'false',
						'url'=>array(
							'action'=>'code_button',
							'controller'=>'templates',
							'plugin'=>'')
						));
					echo $this->Form->input('3digitcode',array(
						'id'=>'code',
						'type'=>'number',
						'placeholder'=>'Enter Code',						
						'label'=>false
						));		

						echo $this->Form->input('',array(
						'type'=>'button',
						'id'=>'code_button',
						'div'=>'false',
						'label'=>false,
						'type' => 'hidden'
						));
					echo $this->Form->end();
					?>
				</div>
				
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>