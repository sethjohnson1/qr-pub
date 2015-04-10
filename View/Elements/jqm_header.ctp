<?
?>
<style type="text/css">
 .top_logo{
	margin:6px 0px 0px 10px;
	padding: 0px;
	z-index: 100;
	position:relative;
	top: 14px;
	float:left;
}

	.ui-body-a{
		border-width:0px;
	}

/* the header height is smaller than the wrapper so the logo overcomes it */

.kiosk-header{
	height:53px;
	background-color: #ffffff !important;
}
.header{
	border-bottom: 9px solid #aa9c8f;
	background-color: #ffffff !important;
	height:91px;
}

.headerwrapper{
	max-width:1100px;
	margin:auto;
	height:100px;
}


.menubuttons{
	float:right;
	padding:11px 23px 0 0;
}

form.CodeForm .input.number .ui-input-text{
	width:120px;
	font-size:17px !important;
}


</style>
<?


echo $this->element('global_menu');
if (!isset($template['Template']['id'])) $template['Template']['id']=$this->params['action'];
?>
<script>

</script>
<div data-role="page" id="qrpage<?=$template['Template']['id']?>" data-theme="a">
<?if (empty($kioskmode)) $headerclass='header';
	else $headerclass='kiosk-header';
?>
	<?if (empty($kioskmode)):?>
	<div data-role="header" data-position="fixed" class="<?=$headerclass?>">
	<div class="headerwrapper">
	
		<div class="top_logo">
		<? 
		echo $this->Html->image('1-mobile-logo-copy-copy.png',array(
			'url'=>'/',
			'height'=>'80',
			'alt'=>'Center of the West logo',
			'class'=>'toplogoimg'
		));
		?>
		</div>
				<div class="menubuttons">
				<? 
			
				$btnstyle='margin:0px;border-left:none;padding:0 32px 0 0;';
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
				echo $this->Html->link('Login','#userPopup'.$template['Template']['id'],array(
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
						'placeholder'=>' Enter Code ',
						'class'=>'codeinput',
						'id'=>'Code3digitcode'.$template['Template']['id'],
						'label'=>false
						));		
	
					echo $this->Form->end();
					?>
			</div><!-- center div -->
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


	</div><!-- headerwrapper -->
	</div><!-- header -->
	<?endif?>
	<div role="main" class="ui-content ui-body ui-body-a ui-shadow">
	<?
	echo $this->Session->flash();
	//sj - moved this down here so we don't need "Enhance Within" which won't work across multiple pages
	echo $this->element('userPopup'); 
	?>