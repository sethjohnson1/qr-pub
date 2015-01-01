<?php
class UrlShortenerComponent extends Component {
	public $name = 'UrlShortenerComponent';
	
	/*
		$url is URL to shorten
		$source and $medium are for UTM codes (respectively)
	*/
	public function get_bitly_short_url($here,$medium,$source) {
		$url='http://'.$_SERVER['HTTP_HOST'].$here.'?utm_campaign='.Configure::read('bitlyCampaign').'&utm_medium='.$medium.'&utm_source='.$source;
		$connectURL = 'http://api.bit.ly/v3/shorten?login='.Configure::read('bitlyLogin').'&apiKey='
		.Configure::read('bitlyAPIkey').'&uri='.$url.'&format=txt';
		
		return $this->curl_get_contents($connectURL);
		//return 	$connectURL;
	}
 
	private function curl_get_contents($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}
?>