<?
$link=Router::url(array('admin' => false, 'plugin' => 'users','controller' => 'users', 'action' => 'reset_password', $token), true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Password Reset Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body>
		<!-- E-mail content for "Reset your iScout password" -->
	
	<table style="width:600px; border: 1px solid #aa9c8f; background-color:#ede9e7;">
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 18px; color:#766a62; padding:10px;">
			<strong>Hello,</strong>
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">iScout received a request from this e-mail address to reset your password. Click the link below and let's take care of it!
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; padding:10px;">
			
			<?=$this->Html->link('Click this link to reset your password',$link,array('style'=>'color:#bd4f19'))?>

			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 14px; color:#766a62; padding:10px;">If you received this e-mail in error, simply delete it.
			</td>
		</tr>
		<tr>
			<td style="font-family: Verdana, sans-serif; font-size: 16px; color:#bd4f19; padding:10px;">Happy iScouting!</td>
		</tr>
		<tr>
		<td style="padding:10px;">
		<?=$this->Html->image('iScout-Icon-small.gif')?>
		</td>
		</tr>
	</table>
	
	</body>
</html>