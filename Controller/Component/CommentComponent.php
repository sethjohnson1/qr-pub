<?
/*
Returns all comments for a given template, and includes user interaction data where applicable for the commentswidget Element
*/
App::uses('Component', 'Controller');
class CommentComponent extends Component {	
	public $components = array('Cookie');
	function startup(Controller $controller) { $this->Controller = $controller; }
	
	public function getComments ($templateid, $userid){
	$this->Controller->set('cookie_flags',$this->Cookie->read('flagged_comments'));
	//first find all comments that the logged in user has interacted with 
		$model=ClassRegistry::init('CommentsUser');
		$options['joins']= array(
			array(
				'table' => 'comments',
				'alias' => 'Comment1',
				'type' => 'LEFT OUTER',
				'conditions'=>array('CommentsUser.comment_id = Comment1.id','Comment1.template_id'=>$templateid)
			));
		$options['recursive']=2;
		$options['limit']=200;
		//this is where you could do pagination manually (pass the variable from the controller)
		//$options['offset']=0;
		$options['fields']=array('CommentsUser.*','Comment.*');
		//no, better to sort the array, this is meaningless
		$options['order']=array('Comment.diff desc');
		$options['conditions']=array('CommentsUser.user_id'=>$userid,'Comment.template_id'=>$templateid,'Comment.hidden != 1');

		$comment=$model->find('all',$options);
		//now loop through and extract the ids to exclude from the next query
		$exclusions=array();
		foreach ($comment as $key=>$val){
			$exclusions[$key]="Comment.id != '".$val['Comment']['id']."'";
		}
		
		$model=ClassRegistry::init('Comment');
		$comment2=$model->find('all',array(
			'conditions'=>array('Comment.hidden != 1','Comment.template_id'=>$templateid,'AND'=>array($exclusions)),
			'recursive'=>1,
			'fields'=>array('Comment.*','User.*'),
			'limit'=>200,
			'order'=>'Comment.diff desc'
		));
		$comment3=array();
		foreach ($comment2 as $key=>$value){
			$comment3[$key]['Comment']=$value['Comment'];
			$comment3[$key]['Comment']['User']=$value['User'];
		}
		$result=array_merge($comment,$comment3);
		return $result;
	}
	
	//$id is the id of the comment
	public function getComment ($id){
		$model=ClassRegistry::init('CommentsUser');
		$comment=$model->find('first',array(
			'conditions'=>array('CommentsUser.comment_id'=>$id),
			'recursive'=>2,
			'fields'=>array('Comment.*','CommentsUser.*'),
			'limit'=>200,
			'order'=>'Comment.diff desc'
		));
		//$result=array_merge($comment,$comment3);
		$comment['Comment']['User']=$comment['Comment']['Comment']['User'];
		unset($comment['Comment']['Comment']);
		return $comment;
	}
	
	public function userComment ($templateid, $userid){
		$model=ClassRegistry::init('Comment');
		$options['conditions']=array('Comment.template_id'=>$templateid,'Comment.user_id'=>$userid);
		$options['recursive']=1;
		//should only return one record
		$result=$model->find('first',$options);
		return $result;
	}
		
}