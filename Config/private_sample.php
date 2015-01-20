<?php
//specify the FROM mail
$from_email=array('me@example.com'=>'My Name');

$config = array(
  'database' => array(
    'test' => array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => '',
    ),
    'default' => array(
      'datasource' => 'Database/Mysql',
      'persistent' => false,
      'host' => 'localhost',
      'login' => 'root',
      'password' => '',
      'database' => 'oc_dl',
    ),
  ),
	'email'=>array(
		'default'=>array(
			'transport' => 'Mail',
			'from' => 'admin@example.com',
			//'charset' => 'utf-8',
			//'headerCharset' => 'utf-8',
		),
		//this is read as the 'default' and can be changed in Config/email.php
		'office365'=>array(
			'from' => $from_email,
			'transport' => 'Smtp',
			'host' => 'smtp.office365.com',
			'port' => 587,
			'username' => '****',
			'password' => '****',
			'client' => null,
			'log' => true,
			'tls' => true
		),
	)
);


Configure::write('debug', 2);

Configure::write('Security.salt', 'qwewrtyuiop123');
Configure::write('Security.cipherSeed', '987654321');

//no trailing slash!
Configure::write('globalSiteURL','http://example.com');
// set this to 1 to enable backend interface, so in production it should NOT be 1
Configure::write('enableAdminFunctions',1);

//kiosk mode disables the sign-in features and whatever else
Configure::write('enableKioskMode',1);

//put the id of the template you want to be the default "home" page, index route uses it
Configure::write('defaultTemplate',1);

//the name of the user allowed to see all templates. This is part of basic security for templates
//this user can see all templates
Configure::write('globalSuperUser','superuser');

//this account receives e-mail
Configure::write('globalAdminEmail','admin@example.com');
Configure::write('globalFromEmail',$from_email);

//for Bit.Ly shortening
Configure::write('bitlyAPIkey','');
Configure::write('bitlyLogin','');
//to add to UTM tracking codes
Configure::write('bitlyCampaign','iScout');

//for ExtAuth plugin
Configure::write('ExtAuth.Provider.Google.key', '');
Configure::write('ExtAuth.Provider.Google.secret', '');

Configure::write('ExtAuth.Provider.Facebook.key', '');
Configure::write('ExtAuth.Provider.Facebook.secret', '');

Configure::write('ExtAuth.Provider.Twitter.key', '');
Configure::write('ExtAuth.Provider.Twitter.secret', '');

?>
