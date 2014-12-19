<div id="CodePopUp">
	<form>
		<div style="padding:10px 20px;">
			<h3>Enter Code</h3>
			<label for="un" class="ui-hidden-accessible">Code:</label>
			<input type="text" name="user" id="un" value="" placeholder="Code" data-theme="a">
			<button type="submit" class="ui-btn ui-btn-icon-left ui-icon-check">Go</button>
		</div>
	</form>
</div>
<div id="Scorecard">

	<div style="padding:10px 20px;">
		<h3>Score Card</h3>
		<div class="ui-grid-a">
			<div class="ui-block-a">BBM</div>
			<div class="ui-block-b">CFM</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a">DMNH</div>
			<div class="ui-block-b">MRL</div>
		</div>
		<div class="ui-grid-a">
			<div class="ui-block-a">PIM</div>
			<div class="ui-block-b">WGWA</div>
		</div>
		<div class="ui-grid-solo"><a href="#" class="ui-btn">Clear All Scanned</a></div>
	</div>
</div>
<div data-role="page">
	<div data-role="header" data-position="fixed" style="border-bottom:9px solid #6E3219;background-color:#fff;">
		<div class="ui-block-a"><h1 style="margin:0px 0px 0px 10px;padding: 0px;z-index: 100;position: relative;top: 19px; float:left"><? echo $this->Html->image('mobile-logo.png', array('url' => array('controller'=>'internships','action'=>'index')));?></h1></div>
		<div class="ui-block-b">&nbsp;</div>
		<div class="ui-block-c">&nbsp;</div>
		<div class="ui-block-d">&nbsp;</div>
		<div class="ui-block-e">
			<div class="ui-btn-right ui-grid-a">
				<div align="center"><a href="#menu" data-icon="bars" data-iconpos="notext" data-corners="false" data-role="button" style="margin:0px;border-left:none;" class="ui-link ui-btn ui-icon-bars ui-btn-icon-notext ui-shadow" role="button">Menu</a></div>
				<div class="ui-block-solo"><? echo $this->Html->link('Enter Code','#CodePopUp',array('class'=>'ui-btn','data-rel'=>'popup','data-position-to'=>'window'));?></div>
			</div>
		</div>
	</div>
	<div role="main" class="ui-content">