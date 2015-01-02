<!DOCTYPE html>
<html>
<head>
	<title>
iScout | <? echo $this->fetch('title'); ?>
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	
	<?
		echo $this->Html->meta('description', $meta_description );
		echo $this->Html->css('jquery.mobile-1.4.5');	
		echo $this->Html->css('themes/iscout1.min');		
		echo $this->Html->css('themes/jquery.mobile.icons.min');		
		echo $this->Html->css('style');		
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->script('jquery.mobile-1.4.5');		
		echo $this->Html->script('qr_scripts');
		
		echo $this->fetch('script');
		echo $this->fetch('css');
		echo $this->fetch('meta');
	?>
</head>
<body>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); 
	?>
</body>
</html>
