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
Configure::write('globalSiteURL','http://example.com');
//not used anywhere yet, because I'll make a new o365 account for this (that someone else monitors!)
Configure::write('globalAdminEmail','admin@example.com');

//the address that messages send from, forms will be fine for all testing
Configure::write('globalFromEmail','curator@example.com');

?>
