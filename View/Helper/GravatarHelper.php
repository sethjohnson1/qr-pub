<?php
App::uses('AppHelper', 'View/Helper');
class GravatarHelper extends AppHelper  {
	public $helpers = array('Html');
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */ 
	function get_gravatar( $email, $img, $alt) {
		$s = 80;
		$d = 'mm';
		$r = 'pg';
		$url = 'http://www.gravatar.com/avatar/';
		$url .= md5( strtolower( trim( $email ) ) );
		$url .= "?s=$s&d=$d&r=$r";
	/* sj - we only want the URL now
		if ( $img ) {
			return $this->Html->image($url,array('alt'=>$alt));
		}
		*/
		return $url;
	}
}
?>