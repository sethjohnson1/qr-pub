<?php

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
  )
);


Configure::write('debug', 2);
Configure::write('Security.salt', 'qwewrtyuiop123');
Configure::write('Security.cipherSeed', '987654321');
//no trailing slash!
Configure::write('globalSiteURL','http://example.com');
//this account receives e-mail
Configure::write('globalAdminEmail','admin@example.com');

//the address that messages send from, necessary for o365
Configure::write('globalFromEmail','curator@example.com');

//for ExtAuth plugin
Configure::write('ExtAuth.Provider.Google.key', '');
Configure::write('ExtAuth.Provider.Google.secret', '');

Configure::write('ExtAuth.Provider.Facebook.key', '');
Configure::write('ExtAuth.Provider.Facebook.secret', '');

Configure::write('ExtAuth.Provider.Twitter.key', '');
Configure::write('ExtAuth.Provider.Twitter.secret', '');

?>
