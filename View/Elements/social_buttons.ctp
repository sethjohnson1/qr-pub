<?			
if ($user['provider']=='Twitter'){
	echo $this->Html->link('Tweet','https://twitter.com/share?via=centerofthewest&hastags=iscout&text='.'Check out this cool exhibit'.'&url='.$shorturl, array(
		'data-role'=>'button',
		'data-icon'=>'iscout-whitetwittericon',
		'data-theme'=>'d',
		'target'=>'_blank'
	));
}
if ($user['provider']=='Facebook'){
	echo $this->Html->link('Post to Facebook','http://www.facebook.com/share.php?u='.$shorturl, array(
		'data-role'=>'button',
		'data-theme'=>'b',
		'data-icon'=>'iscout-whitefbicon',
		'target'=>'_blank'
	));
}
if ($user['provider']=='Google'){
	echo $this->Html->link('Google+','https://plus.google.com/share?url='.$shorturl, array(
		'data-role'=>'button',
		'data-theme'=>'c',
		'data-icon'=>'iscout-whitegoogleplusicon',
		'target'=>'_blank'
	));
}
if ($user['provider']=='email'){
	?>
	<h3>We'll e-mail you a pre-formatted message that you can forward on.</h3>
	<?
	//sj - override $shorturl because it make e-mails Spammy
	$shorturl='http://'.$_SERVER['HTTP_HOST'].$this->here;
	echo $this->Html->link('E-mail me',array('controller'=>'templates','action'=>'email',$template['Template']['id'],urlencode($shorturl)), array(
		'data-role'=>'button',
		'data-theme'=>'e',
		'data-ajax'=>'false'
	));
}


			
?>