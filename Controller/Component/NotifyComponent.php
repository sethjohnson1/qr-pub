<?
/*
Returns all comments for a given template, and includes user interaction data where applicable for the commentswidget Element
*/
App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class NotifyComponent extends Component {	
	public $components = array('Cookie');
	function startup(Controller $controller) { $this->Controller = $controller; }


	public function emailAdmin($comment,$user){
	
	//999 is the lost gun, so put Ashley's e-mail here
	$to='web@centerofthewest.org';
	if ($comment['rating']==999) $to='seth@sethjohnson.net'; 
	
	$notice='';
	if ($comment['hidden']) $notice=" ** This comment was already hidden, if you wish to UNHIDE it click the link below, otherwise do nothing ** \n\n";
	
	$clink=Configure::read('globalSiteURL').'/commentsUsers/secret_toggle/'.$comment['id'].'/'.$comment['secret_uuid'];
	if (isset($user['email'])) $oid=$user['email'];
	else $oid=$user['oid'];
	//need to add something if Kiosk users
		$Email = new CakeEmail();
		$Email->from(Configure::read('globalFromEmail'))
			->to($to)
			->subject('iScout Comment Submitted')
			->send(
			$comment['thoughts']."\n\nFrom: ".$oid."\n\n".$notice.$clink
			);
		return true;
	}
	
		
}