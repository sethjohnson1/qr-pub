<?php

class EmailConfig {

	 //Read updates from private config file app/Config/private.php
	public function __construct() {
	        //$this->default = Configure::read('email.default');
	        $this->default = Configure::read('email.office365');
	}
	
}
