<?php
App::uses('AppController', 'Controller');

class CommentsUsersController extends AppController {

	public $components = array('Paginator','Comment');
	public function beforeFilter() {
		parent::beforeFilter();
	//	$this->Security->blackHoleCallback = 'blackhole';
	}
	public function blackhole($type) {
		//debug($type);
		$this->Session->setFlash($type,'flash_custom');
	}
	
	//$id is the id of the Comment
	//$flag is whether to flag or unflag (1, -1)
	public function comment_flag($id = null,$templateid=null,$flag=null) {
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				$commentsuser=$this->CommentsUser->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$user['id'])
				));
				$this->CommentsUser->create();
				if (isset($commentsuser['CommentsUser']['id'])){
					$data['id']=$commentsuser['CommentsUser']['id'];
					//do nothing if same choice
					if ($commentsuser['CommentsUser']['flagged'] == true && $flag==1) return true;
					if ($commentsuser['CommentsUser']['flagged'] == false && $flag==-1) return true;
				}
				$data['user_id']=$user['id'];
				$data['comment_id']=$id;
				if ($flag==1) $data['flagged']=true;
				if ($flag==-1) $data['flagged']=false;
				if ($this->CommentsUser->save($data)){
					$this->CommentsUser->Comment->create();
					$commentdata=$this->CommentsUser->Comment->find('first',array(
						'conditions'=>array('Comment.id'=>$id),
						'recursive'=>-1
					));
					$commentdata['Comment']['flags']=$commentdata['Comment']['flags']+$flag;
					if ($this->CommentsUser->Comment->save($commentdata)){
						//flash message?
					}
				}
			}
			else {
				$this->Session->setFlash('Create an account to permanently hide flagged comments.','flash_custom',array(),'commentFlash');
				//makes a cookie for flagged comments, this is read and set from CommentComponent
				$cookie=$this->Cookie->read('flagged_comments');
				if ($flag==1) $cookie[$id]=true;
				if ($flag==-1) unset($cookie[$id]);
				$this->Cookie->write('flagged_comments',$cookie, false, '1 year');
				$user['id']=null;
			}
			$comments=$this->Comment->getComments($templateid,$user['id']);
			$this->set(compact('comments','user'));
			$this->render('comment_add','ajax');
		//}
	}
	
	//$id is the id of the Template
	public function comment_add($id = null, $parentid=null) {
	/* technically this should be on the Comment controller, as the junc table has nothing to do with add
	   but it seems better to have all of these in one place
	FLAW: HTML tags are currently not stripped out, mainly because I plan to use them. The SecurityComponent should prevent anything bad from happening,
	but if not then we'll strip HTML tags too
	   */
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('Comment.template_id'=>$this->request->data['sComment']['id'],'Comment.user_id'=>$user['id'])
				));
				if (isset($commentdata['Comment']['id'])){
					$comment['id']=$commentdata['Comment']['id'];
				}
				else {
					$uuid=String::uuid();
					$comment['id']=$uuid;
				}
				$comment['thoughts']=$this->request->data['sComment']['comment'];
				$comment['rating']=$this->request->data['sComment']['rating'];
				$comment['user_id']=$this->Auth->user('id');
				//this would be better passed in hidden field!
				$comment['template_id']=$this->request->data['sComment']['id'];
				$comment['hidden']=0;
				if (isset($parentid)) $comment['parent_id']=$parentid;
				$this->CommentsUser->Comment->create();
				if ($this->CommentsUser->Comment->save($comment)){
					//maybe start setting flash messages here?
				}
			}
			else {
				$this->Session->setFlash('You must be logged in to do this','flash_custom',array(),'commentFlash');
				$user['id']=null;
			}
			//Comment component..
			$comments=$this->Comment->getComments($id,$user['id']);
			$this->set(compact('comment','comments','user','id'));
			$this->render('comment_add','ajax');
			
		//}
	}	
	
	//this upvotes and downvotes
	//$id is the comment id
	public function comment_up($id = null, $templateid=null, $vote=null) {
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				//eventually want to add counts to user, moving on for now
				// (i left everything in place, but it doesn't work right)
				$user=$this->Auth->user();
				//debug($user);
				$data['user_id']=$this->Auth->user('id');
				$data['comment_id']=$id;
				//this button should be disabled if they already upvoted, but we'll check the count here anyway
				//this is flawed because what if.. yeah
				$commentuser=$this->CommentsUser->find('first',array(
					'conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$this->Auth->user('id')),
					'recursive'=>-1
				));
				$commentdata=$this->CommentsUser->Comment->find('first',array(
				'recursive'=>-1,
				'conditions'=>array('Comment.id'=>$id)
				
				));
				$this->CommentsUser->create();
				//THIS IS WHERE I LEFT OFF for Issue #5
				// the problem is that Auth does not refresh on these Ajax calls, so it keeps getting set to null
				if(!empty($commentuser)){
					if ($vote==1 && $commentuser['CommentsUser']['upvoted']!=true){
						$data['id']=$commentuser['CommentsUser']['id'];
						//means we're reversing direction
						if ($commentuser['CommentsUser']['downvoted']==true){
							//debug('subtract one');
							$data['upvoted']=false;
							$data['downvoted']=false;
							$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']-1;
							//debug($user['downvotes']);
							$user['downvotes']=$user['downvotes']-1;
							//debug($user['downvotes']);
						}
						else {
							$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
							$user['upvotes']=$user['upvotes']+1;
							unset($commentdata['Comment']['downvotes']);
							unset($user['downvotes']);
							$data['upvoted']=true;
						}
						//$data['vote']=1;
					}
					else if ($vote==-1 && $commentuser['CommentsUser']['downvoted']!=true){
						$data['id']=$commentuser['CommentsUser']['id'];
							if ($commentuser['CommentsUser']['upvoted']==true){
								$data['upvoted']=false;
								$data['downvoted']=false;
								$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']-1;
								$user['upvotes']=$user['upvotes']-1;
								//debug($user);
							}
							else {
								$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
								//$user['downvotes']=$user['downvotes']+1;
								unset($commentdata['Comment']['upvotes']);
								unset($user['upvotes']);
								$data['downvoted']=true;
							}
					}
					else {
						//they have already voted this way or something else is wrong
						return false;
						//just for testing
					//	debug('throw out!');
						//$data['id']=$commentuser['CommentsUser']['id'];
					}
				}
				//comment is empty
				else {
					if ($vote==1){ 
						$data['upvoted']=true;
						$data['already_upvoted']=true;
						$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
						//$user['upvotes']=$user['upvotes']+1;
						//unset($user['downvotes']);
						unset($commentdata['Comment']['downvotes']);
					}
					if ($vote==-1){
						$data['downvoted']=1;
						$data['already_downvoted']=1;
						$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
						$user['downvotes']=$user['downvotes']+1;
						//unset($user['upvotes']);
						unset($commentdata['Comment']['upvotes']);
					}
				}

				if($this->CommentsUser->save($data)){
					//update the actual comment with the new total
					$this->CommentsUser->Comment->create();
					$commentdata['Comment']['id']=$id;
					//debug($commentdata);
					if ($this->CommentsUser->Comment->save($commentdata['Comment'])){
						
						 //would save the counts here
						if ($this->CommentsUser->User->save($user)){
							//wow, it all went through
						}
					}
				}
					
			}
			else {
				$this->Session->setFlash('You must be logged in to upvote and downvote.','flash_custom',array(),'commentFlash');
				$user['id']=null;
			}
			$comments=$this->Comment->getComments($templateid,$user['id']);
			
			//debug($comments);
			$this->set(compact('comments','user'));
			$this->render('comment_add','ajax');
		//}
	
	}
	
	//$id is the id of the comment
	public function comment_hide($id = null, $parentid=null) {
	//debug($id);
	//technically this should be on the Comment controller as well
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment and that it matches the logged in user
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>1,
					'conditions'=>array('Comment.id'=>$id,'Comment.user_id'=>$user['id'])
				));
				//debug($commentdata);
				if (isset($commentdata['Comment']['id'])){
					$commentdata['Comment']['hidden']=1;
					$this->CommentsUser->Comment->create();
					if ($this->CommentsUser->Comment->save($commentdata)){
						$this->Session->setFlash('Comment hidden. Feel free to update and resubmit.','flash_custom',array(),'commentFlash');
					}
					else {
						//debug('went badly');
					}
				}
				else {
					return true;
				}
				
			}
			else {
				$this->Session->setFlash('account mismatch','flash_custom',array(),'commentFlash');
				$user['id']=null;
			}
			$comments=$this->Comment->getComments($commentdata['Template']['id'],$user['id']);
			$this->set(compact('comments','user'));
			$this->render('comment_add','ajax');
		//}
	}	

}
