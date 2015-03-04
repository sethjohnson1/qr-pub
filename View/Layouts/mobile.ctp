<!DOCTYPE html>
<html>
<head>
	<title>
iScout | <? echo $this->fetch('title'); ?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<?
	
	/*
		the iscroll scripts must be enabled if you want to go back that way.....
	*/
		echo $this->Html->meta('description', $meta_description );
		echo $this->Html->css('jquery.mobile-1.4.5');	
		echo $this->Html->css('themes/iscout1.min');		
		echo $this->Html->css('themes/jquery.mobile.icons.min');		
		//echo $this->Html->css('jquery.mobile.iscrollview');		
		//echo $this->Html->css('jquery.mobile.iscrollview-pull');		
		echo $this->Html->css('style');		
		
		
		
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('jquery.mobile-1.4.5.min');		
		//echo $this->Html->script('iscroll');		
		//echo $this->Html->script('jquery.mobile.iscrollview');		
		echo $this->Html->script('qr_scripts');
		
		echo $this->fetch('script');
		echo $this->fetch('css');
		echo $this->fetch('meta');
	?>
<script type="text/javascript">
var _gas = _gas || [];
_gas.push(['_setAccount', 'UA-46559601-1']); 
_gas.push(['_setDomainName', '.centerofthewest.org']);
_gas.push(['_require', 'inpage_linkid','//www.google-analytics.com/plugins/ga/inpage_linkid.js']);
_gas.push(['_trackPageview']);
_gas.push(['_gasTrackForms']);
_gas.push(['_gasTrackOutboundLinks']);
_gas.push(['_gasTrackMaxScroll']);
_gas.push(['_gasTrackDownloads']);
_gas.push(['_gasTrackVideo']); _gas.push(['_gasTrackAudio']);
_gas.push(['_gasTrackYoutube', {force: true}]);
_gas.push(['_gasTrackMailto']);

(function() {
var ga = document.createElement('script');
ga.id = 'gas-script';
ga.setAttribute('data-use-dcjs', 'true'); // CHANGE TO TRUE FOR DC.JS SUPPORT
ga.type = 'text/javascript';
ga.async = true;
ga.src = '//cdnjs.cloudflare.com/ajax/libs/gas/1.11.0/gas.min.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<body>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); 
	?>
</body>
</html>
