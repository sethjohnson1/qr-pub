<?
//this is used to get all the right variables for the commentsWidget Element (at the moment)
App::uses('Component', 'Controller');
class CommentComponent extends Component {

	//returns all the comments for a template
    public function getComments ($templateid) {
		$model=ClassRegistry::init('Comment');
		//$comments = $model->find('all');
		$comments=$model->find('all',array(
			'conditions'=>array('Comment.template_id'=>$templateid),
			'recursive'=>-1
		));
		return $comments;
    }
	
	//returns the logged in users interactions with comments on the template
	
	public function userComment ($templateid, $userid){
		$model=ClassRegistry::init('Comment');
			$comments=$model->find('all',array(
				'conditions'=>array('Comment.template_id'=>$templateid),
				'recursive'=>-1
			));
	
	//this is good, now could be merged with other array to make this a single function  
		$model=ClassRegistry::init('CommentsUser');
		$options['joins']= array(
			array(
				'table' => 'comments',
				'alias' => 'Comment1',
				'type' => 'LEFT OUTER',
				'conditions'=>array('CommentsUser.comment_id = Comment1.id','Comment1.template_id'=>$templateid)
		
		));
		$options['recursive']=1;
		$options['conditions']=array('CommentsUser.user_id'=>$userid,'Comment.template_id'=>$templateid);
		
		$comment=$model->find('all',$options);
/*		
		$options['joins']= array(
			array(
				'table' => 'comments',
				'alias' => 'Comment1',
				'type' => 'LEFT OUTER',
				'conditions'=>array('CommentsUser.comment_id = Comment1.id','Comment1.template_id'=>$templateid)
		
		));
		$options['recursive']=0;
		$options['conditions']=array('CommentsUser.user_id !='.$userid,'Comment.template_id'=>$templateid);
		
		$comment2=$model->find('all',$options);
	*/	
		return $comment;
		
		/*
		$comment=$model->find('all',array(
			'conditions'=>array('Comment.template_id'=>$templateid,'Comment.user_id'=>$userid),
			'recursive'=>-1
		)); */
	}
	
	/*
	this was the original working version that didn't have the right idea
	public function userComment ($templateid, $userid){
	//this could probably be simplified to one query with a join or something
	$finalval=array();
		$model=ClassRegistry::init('Comment');
		$comment=$model->find('first',array(
			'conditions'=>array('Comment.template_id'=>$templateid,'Comment.user_id'=>$userid),
			'recursive'=>-1
		));
		if (isset($comment['Comment']['id'])) {
			$finalval['Comment']=$comment['Comment'];
			$model=ClassRegistry::init('CommentsUser');
			$usercomments=$model->find('all',array(
				'conditions'=>array('CommentsUser.comment_id'=>$comment['Comment']['id'],'CommentsUser.user_id'=>$userid),
				'recursive'=>-1
			));
			if (isset($usercomments['CommentsUser']['id'])) $finalval['CommentsUser']=$usercomments['CommentsUser'];
			return $finalval;
		}
		else return null;

	}
	
	*/
	
	
	
	
}