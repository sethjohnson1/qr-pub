<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>iScout Email Share</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<!-- E-mail content for sharing via e-mail -->
	
	<table style="width:600px; border: 1px solid #aa9c8f; background-color:#ede9e7;">
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 18px; color:#766a62; padding:10px;"><strong>Hello,</strong>
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">
			I'm having a great time with the Buffalo Bill Center of the West's iScout Virtual Tour and thought I'd share it with you!
			I thought you might find this interesting:
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; padding:10px;">
			<?=$this->Html->link($title,$url,array('style'=>'color:#bd4f19'))?>
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">Take the whole tour online at <a style="color:#bd4f19" href="http://iscout.bbcw.org/">iscout.bbcw.org</a> or visit the Center someday&mdash;the tour is more awesome in person!
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; color:#bd4f19; padding:10px;">Happy iScouting!</td>
		</tr>
		<tr>
		<td style="padding:10px;">
		<?=$this->Html->image(Configure::read('globalSiteURL').'/img/iScout-Icon-small.gif')?>
		</td>
		</tr>
	</table>
	
	</body>
</html>