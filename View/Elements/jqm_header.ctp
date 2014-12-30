<?
echo $this->element('Scorecard',array($totals)); 
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
				<a href="#userPopup" style="margin:0px;border-left:none;" data-position-to="window" 
				data-rel="popup" class="ui-link ui-btn ui-icon-user ui-btn-icon-notext ui-shadow" 
				role="button" data-transition="turn">Login</a>
				<a href="#menu" data-icon="bars" data-iconpos="notext" data-corners="false" data-role="button" style="margin:0px;border-left:none;" data-position-to="window" data-rel="pop" class="ui-link ui-btn ui-icon-bars ui-btn-icon-notext ui-shadow" role="button">Menu</a>
				</div>
				
				<div class="ui-block-solo">
				<?
				echo $this->Html->link('Enter Code','#CodePopUp',
				array('class'=>'ui-btn','data-rel'=>'popup','data-position-to'=>'window',
				'data-transition'=>'turn'));?>
				</div>
				
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">
	<?
	echo $this->Session->flash();
	?>