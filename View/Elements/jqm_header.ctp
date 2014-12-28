<?
echo $this->element('Scorecard',array($totals)); 
echo $this->element('CodePopUp'); 
echo $this->element('userPopup'); 
?>
<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
	<h3>Menu</h3>
	<?php echo $this->Html->link('FBAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Facebook'),array('rel'=>'external')); ?><BR>
	<?php echo $this->Html->link('GAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Google'),array('rel'=>'external')); ?><BR>
	<?php echo $this->Html->link('TAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'auth_login','Twitter'),array('rel'=>'external')); ?><BR>
	<?php echo $this->Html->link('DAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'dummyAuth')); ?><BR>
	<?php echo $this->Html->link('UAuth', array('plugin'=>'users','controller' => 'users', 'action' => 'login')); ?><BR>
	<?php echo $this->Html->link('Logout', array('plugin'=>'users','controller' => 'users', 'action' => 'logout')); ?><BR>
	<a href="#demo-links" data-rel="close" class="ui-btn ui-shadow ui-corner-all ui-btn-a ui-icon-delete ui-btn-icon-left ui-btn-inline">Close panel</a>
</div>
<div data-role="page" id="qrpage" data-theme="a">
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
	//debug($this->params['action']);
	?>