<?

//HTML page start
echo '<!DOCTYPE HTML><html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';
echo '<h1>Login with Google</h1>';


	echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';

	print_r($user);
