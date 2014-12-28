<?
/*
Returns all comments for a given template, and includes user interaction data where applicable for the commentswidget Element
*/
App::uses('Component', 'Controller');
class CommentComponent extends Component {	
	public function getComments ($templateid, $userid){
	//first find all comments that the logged in user has interacted with 
		$model=ClassRegistry::init('CommentsUser');
		$options['joins']= array(
			array(
				'table' => 'comments',
				'alias' => 'Comment1',
				'type' => 'LEFT OUTER',
				'conditions'=>array('CommentsUser.comment_id = Comment1.id','Comment1.template_id'=>$templateid)
			));
		$options['recursive']=1;
		$options['limit']=200;
		//this is where you could do pagination manually (pass the variable from the controller)
		//$options['offset']=0;
		$options['fields']=array('CommentsUser.*','Comment.*','User.username');
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
			'fields'=>array('Comment.*','User.username'),
			'limit'=>200
		));
		$result=array_merge($comment,$comment2);
		return $result;
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