<?
if($passed=='header'){?>
<div id="CodePopUp" data-theme="a">
	<form>
		<div style="padding:10px 20px;">
			<h3>Enter Code</h3>
			<label for="un" class="ui-hidden-accessible">Code:</label>
			<input type="text" name="user" id="un" value="" placeholder="Code" data-theme="a">
			<button type="submit" class="ui-btn ui-btn-icon-left ui-icon-check">Go</button>
		</div>
	</form>
</div>
<div id="Scorecard" data-theme="a">
<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		<h3>Score Card</h3>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="myicons" style="color:#6E3219;">a</div>		
			<div class="ui-block-b" id="myicons" style="color:#054552">b</div>						
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">1/2</div>			
			<div class="ui-block-b" id="mycounters">1/2</div>			
		</div>
		<hr>		
		<div class="ui-grid-a">
			<div class="ui-block-a" id="myicons" style="color:#035642">c</div>
			<div class="ui-block-b" id="myicons" style="color:#532E60">d</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">1/2</div>			
			<div class="ui-block-b" id="mycounters">1/2</div>			
		</div>
		<hr>		
		<div class="ui-grid-a">
			<div class="ui-block-a" id="myicons" style="color:#C35118">e</div>
			<div class="ui-block-b" id="myicons" style="color:#981E32">f</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a" id="mycounters">1/2</div>			
			<div class="ui-block-b" id="mycounters">1/2</div>			
		</div>
		
	<div style="padding:10px 20px;">
		<div class="ui-grid-solo"><a href="#" id="clearall" class="ui-btn ui-btn-icon-left ui-icon-delete">Clear All Scanned</a></div>
	</div>
</div>
<div id="menu" data-role="panel" data-position="left" data-display="reveal" data-theme="a">
	<h3>Menu</h3>
	<?php echo $this->Html->link('FBAuth', array('controller' => 'users', 'action' => 'auth_login','Facebook')); ?><BR>
	<?php echo $this->Html->link('GAuth', array('controller' => 'users', 'action' => 'auth_login','Google')); ?><BR>
	<?php echo $this->Html->link('TAuth', array('controller' => 'users', 'action' => 'auth_login','Twitter')); ?><BR>
	<?php echo $this->Html->link('DAuth', array('controller' => 'users', 'action' => 'dummyAuth')); ?><BR>
	<?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?><BR>
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
				<div align="center"><a href="#menu" data-icon="bars" data-iconpos="notext" data-corners="false" data-role="button" style="margin:0px;border-left:none;" data-position-to="window" data-rel="pop" class="ui-link ui-btn ui-icon-bars ui-btn-icon-notext ui-shadow" role="button">Menu</a></div>
				<div class="ui-block-solo"><? echo $this->Html->link('Enter Code','#CodePopUp',array('class'=>'ui-btn','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'turn'));?></div>
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">
<?
}
if($passed=='footer'){
?>
	</div><!-- /content main -->
	<div data-role="footer" data-position="fixed" data-id="myfooter" style="background-color:transparent;border:none;">
	<!--right here we need 2 pull out Qs that 1 for score card and 1 for comments, then also design those panels-->
		<div class="ui-grid-d" style="text-align:center;position: relative;top: 7px;">
			<? echo $this->Html->link('Score Card','#Scorecard',array('class'=>'ui-btn ui-icon-carat-u ui-btn-icon-top','data-rel'=>'popup','data-position-to'=>'window','data-transition'=>'slideup'));?>
			<a href="#" class="ui-btn ui-icon-carat-u ui-btn-icon-top">Comments</a>
			
		</div>
	</div><!-- /footer -->
</div><!-- /page -->
<?
}