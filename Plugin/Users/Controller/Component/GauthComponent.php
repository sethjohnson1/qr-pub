<?
/*sj - very thankful for this article here: http://www.sanwebe.com/2012/11/login-with-google-api-php
 this is a quick-fix for Google login, but it seems to work.
 
 NOTE: I modified the following in the src file so that it ONLY asks for basic profile, the default settings
 were to get e-mail and offline access. Also, I had the perpetual "request for offline" as some person here:
 
 http://stackoverflow.com/questions/21405274/this-app-would-like-to-have-offline-access-when-access-type-online
 
 But the solution for me approval_prompt=auto *did* work for me (though the OP said it didn't for them)
 
 (I couldn't figure out how to pass the parameters properly or if even possible and didn't want to spend too long trying to figure it out.)
 The files in src (you will see my comments marked with an sj should they need revisiting)
 config.php
 contrib/Google_Oauth2Service.php
 auth/Google_OAuth2.php

*/
App::uses('Component', 'Controller');
class GauthComponent extends Component {

	public function getProfile (){
		//include google api files
		require_once 'src/Google_Client.php';
		require_once 'src/contrib/Google_Oauth2Service.php';
		$gClient = new Google_Client();
		$gClient->setApplicationName('iScout Tour');
		$gClient->setClientId(Configure::read('ExtAuth.Provider.Google.key'));
		$gClient->setClientSecret(Configure::read('ExtAuth.Provider.Google.secret'));
		$gClient->setRedirectUri(Configure::read('globalSiteURL').'/users/gauth');
		//$gClient->setDeveloperKey($google_developer_key);

		$google_oauthV2 = new Google_Oauth2Service($gClient);

		//If user wish to log out, we just unset Session variable
		if (isset($_REQUEST['reset'])) 
		{
		  unset($_SESSION['token']);
		  $gClient->revokeToken();
		  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
		}

		//If code is empty, redirect user to google authentication page for code.
		//Code is required to aquire Access Token from google
		//Once we have access token, assign token to session variable
		//and we can redirect user back to page and login.
		if (isset($_GET['code'])) 
		{ 
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
			return;
		}


		if (isset($_SESSION['token'])) 
		{ 
			$gClient->setAccessToken($_SESSION['token']);
		}


		if ($gClient->getAccessToken()) 
		{
			  //For logged in user, get details from google using access token
			  $user 				= $google_oauthV2->userinfo->get();
			  $user_id 				= $user['id'];
			  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
			  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
			  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
			  $_SESSION['token'] 	= $gClient->getAccessToken();
		}
		else 
		{
			//For Guest user, get google login url
			$authUrl = $gClient->createAuthUrl();
		}
		
		return $authUrl;
	}
/*
//HTML page start
echo '<!DOCTYPE HTML><html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';
echo '<h1>Login with Google</h1>';

if(isset($authUrl)) //user is not logged in, show login button
{
	echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
} 
else // user logged in 
{
	print_r($user);
}
*/

}