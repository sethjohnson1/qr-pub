<?
//echo $this->element('Scorecard',array($totals)); 
//if this isn't disabled then the form below won't work.......
//echo $this->element('CodePopUp'); 
echo $this->element('userPopup'); 
echo $this->element('global_menu');
if (!isset($template['Template']['id'])) $template['Template']['id']=$this->params['action'];
?>
<div data-role="page" id="qrpage<?=$template['Template']['id']?>" data-theme="a">
	<div data-role="header" data-position="fixed" style="border-bottom:9px solid #aa9c8f;background-color:#fff;">
		<div class="ui-block-a"><h1 style="margin:0px 0px 0px 10px;padding: 0px;z-index: 100;position:relative;
		top: 19px; float:left">
		<? 
		echo $this->Html->image('mobile-logo.png',array(
			'url'=>'/',
			'height'=>'78',
			'width'=>'150',
			'alt'=>'Center of the West logo',
			'class'=>'goaway'
			
			));
		?>
		</h1></div>
		<div class="ui-block-b">&nbsp;</div>
		<div class="ui-block-c">&nbsp;</div>
		<div class="ui-block-d">&nbsp;</div>
		<div class="ui-block-e">
			<? if (Configure::read('enableKioskMode')!=1):?>
			<div class="ui-btn-right ui-grid-a">
				<div align="center">
				<? 
			
				$btnstyle='margin:0px;border-left:none;padding:0 27px 0 0;';
				if (isset($user['provider'])){
				
					if ($user['provider']=='email' || $user['provider']=='kiosk'){
						$datatheme='f';
						$dataicon='mail';
					}
					//sj- changed this to white icons, not sure which one I like better
					//but this stands out more
					else if ($user['provider']=='Facebook'){
						$datatheme='b';
						$dataicon='iscout-whitefbicon';
						
					}
					else if ($user['provider']=='Google'){
						$datatheme='c';
						$dataicon='iscout-whitegoogleplusicon';
						
					}
					else if ($user['provider']=='Twitter'){
						$datatheme='d';
						$dataicon='iscout-whitetwittericon';
					}
					else {
						$datatheme='a';
						$dataicon='user';
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
						//necessary since manually ajaxing, otherwise Enter submit using defaults
						'data-ajax'=>'false',
						'id'=>'CodeForm'.$template['Template']['id'],
						//'id'=>'CodeForm',
						'class'=>'CodeForm',
						'div'=>'false',
						'url'=>array(
							'action'=>'code_button',
							'controller'=>'templates',
							'plugin'=>'')
						));
					echo $this->Form->input('3digitcode',array(
						'type'=>'number',
						'placeholder'=>' Code # ',	
						'id'=>'Code3digitcode'.$template['Template']['id'],
						//'class'=>'Code3digitcode',
						'label'=>false
						));		
	
					echo $this->Form->end();
					?>
				</div>
				
			</div><!-- /button block -->
			<?endif?>
		</div><!-- /ui-block-e -->
		<script type="text/javascript">
//just know that without unique IDs (and class names don't work) everything falls apart  
//auto-submit form after 3 characters
	$('input#Code3digitcode<?=$template['Template']['id']?>').keyup(function() {
		if (this.value.length ==3){
		//same ajax call as below, could probably be combined
			$.mobile.loading( 'show', {
				text: 'Finding '+this.value+'...',
				textVisible: true,
				theme: 'a',
				html: ""
			});    
		
			$.ajax({
				async:true,
				data:$("#CodeForm<?=$template['Template']['id']?>").serialize(),
				dataType:"html",
				success:function (data, textStatus) {
					//console.log(data);
					window.location="<? echo Configure::read('globalSiteURL'); ?>/templates/code_button/"+data;
				},
				type:"POST",
				url:"<? echo Configure::read('globalSiteURL'); ?>/templates/code_button"
			});
			return false;
		}
	});
	
	
	//listens for 'tab' or 'enter' - tab is necessary for Android (although this all may be moot considering count above)
	$('input#Code3digitcode<?=$template['Template']['id']?>').on('keydown', function(e){
	 //e.preventDefault();
	console.log('down');
		if(e.which === 9 || e.which===13) {
			$.mobile.loading( 'show', {
				text: 'Finding '+this.value+'...',
				textVisible: true,
				theme: 'a',
				html: ""
			});
		
			$.ajax({
					async:true,
					data:$("#CodeForm<?=$template['Template']['id']?>").serialize(),
					dataType:"html",
					success:function (data, textStatus) {
						$('#CodeForm<?=$template['Template']['id']?>').attr('id','bogus_id');
						
						//console.log(data);
						//return false;
						window.location="<? echo Configure::read('globalSiteURL'); ?>/templates/code_button/"+data;
					},
					type:"POST",
					url:"<? echo Configure::read('globalSiteURL'); ?>/templates/code_button"
				});
		//without this, iOS (and maybe others) will submit without Ajax (sometimes)
		return false;
		}
		
	});

	</script>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>