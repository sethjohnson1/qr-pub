<!DOCTYPE html>
<html>
<head>
	<title>
Internships
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php
	
		echo $this->Html->meta('icon');
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
		echo $this->Html->css('jquery.mobile-1.4.5');		
		echo $this->html->script('jquery.mobile-1.4.5');

		echo $this->fetch('script');
		echo $this->fetch('css');
		echo $this->fetch('meta');
	?>

</head>
<body>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
</body>
</html>
