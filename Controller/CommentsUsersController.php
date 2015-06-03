<?php
App::uses('AppController', 'Controller');
class CommentsUsersController extends AppController {
	public $components = array('Paginator','Comment','Notify');
	public function beforeFilter() {
		parent::beforeFilter();
	//	$this->Security->blackHoleCallback = 'blackhole';
	}
	public function blackhole($type) {
		//debug($type);
		$this->Session->setFlash($type,'flash_custom');
	}
	
	//$id is the id of the Comment
	//$flag is whether to flag or unflag (1, -1, reveal)
	public function comment_flag($id = null) {
		if ($this->request->is('post')){
			if ($this->Auth->user()){
				$flag=0;
				if ($this->request->data[$id]['pflag']=='flag') $flag=1;
				if ($this->request->data[$id]['pflag']=='unflag') $flag=-1;
				//find the user rather than first method for proper flag totals
				//$user=$this->Auth->user();
				$user=$this->CommentsUser->User->find('first',array(
					'conditions'=>array('User.id'=>$this->Auth->user('id')),
					'recursive'=>-1	
				));
				$user=$user['User'];
				//first do the flag totals, no need for IF statement as its just a tally for the user
				if ($flag==1){
					$userdata['id']=$user['id'];
					$userdata['flags']=$user['flags'];
					$userdata['flags']++;
					//$this->CommentsUser->User->create();
					if ($this->CommentsUser->User->save($userdata));
				}
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
				if ($this->request->data[$id]['pflag']=='flag') $data['flagged']=true;
				if ($this->request->data[$id]['pflag']=='unflag') $data['flagged']=false;
				if ($this->CommentsUser->save($data)){
				
					$this->CommentsUser->Comment->create();
					$commentdata=$this->CommentsUser->Comment->find('first',array(
						'conditions'=>array('Comment.id'=>$id),
						'recursive'=>-1
					));
					//only do math on Comment if its a NEW flag or the same user unflagging
					if ((isset($commentsuser['CommentsUser']['id']) && $flag==-1) || ($flag==1)){
						$commentdata['Comment']['flags']=$commentdata['Comment']['flags']+$flag;
					}
					if ($this->CommentsUser->Comment->save($commentdata)){
						//flash message?
					}
				}
			}
			else {
				$this->Session->setFlash('Create an account to permanently flag and unflag comments.','flash_custom',array(),'commentFlash');
				//makes a cookie for flagged comments, this is read and set from CommentComponent
				$cookie=$this->Cookie->read('flagged_comments');
				if ($this->request->data[$id]['pflag']=='flag') $cookie[$id]=true;
				if ($this->request->data[$id]['pflag']=='unflag') unset($cookie[$id]);
			//	debug($this->request->data);
				$this->Cookie->write('flagged_comments',$cookie, false, '1 year');
				//$user['username']='test';
				$user['id']=null;
			}
		
			$comment=$this->Comment->getComment($id,$user['id']);
			if ($this->request->data[$id]['pflag']=='reveal') $this->set('reveal',true);
			$this->set(compact('comment','user'));
			$this->render('comment_single','ajax');
		}
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
				//first see if this is an existing comment, unless kiosk user (the is_kiosk variable is misleading, it means "Is kiosk user"
				$kname=explode('_',$user['id']);
				if ($kname[0]!='kiosk'){
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('Comment.template_id'=>$this->request->data['sComment']['id'],'Comment.user_id'=>$user['id'])
				));
				$is_kiosk='';
				}
				else{
					$is_kiosk=Configure::read('enableKioskMode');
					$user['oid']='kiosk';
				}
				if (isset($commentdata['Comment']['id'])){
					$comment['id']=$commentdata['Comment']['id'];
					$comment['hidden']=$commentdata['Comment']['hidden'];
					$comment['secret_uuid']=$commentdata['Comment']['secret_uuid'];
				}
				else {
					$this->CommentsUser->Comment->create();
					$comment['id']=String::uuid();
					$comment['secret_uuid']=String::uuid();
					$comment['hidden']=0;
				}
				$comment['thoughts']=$this->request->data['sComment']['comment'];
				$comment['rating']=$this->request->data['sComment']['rating'];
				$comment['user_id']=$this->Auth->user('id');
				$comment['template_id']=$this->request->data['sComment']['id'];
				if (isset($parentid)) $comment['parent_id']=$parentid;
				//$this->CommentsUser->Comment->create();
				if ($this->CommentsUser->Comment->save($comment)){
						$this->Session->setFlash('Your comment was noted.','flash_custom',array(),'commentFlash');
						$this->Notify->emailAdmin($comment,$user);
				}
			}
			else {
				$this->Session->setFlash('You must be logged in to do this','flash_custom',array(),'commentFlash');
				$user['id']=null;
			}
			//Comment component..
			$comments=$this->Comment->getComments($id,$user['id']);
			$this->set(compact('comment','comments','user','id','is_kiosk'));
			$this->render('comment_add','ajax');
			
		//}
	}	
	
	//this upvotes and downvotes
	//$id is the comment id
	public function comment_up($id = null, $templateid=null, $vote=null) {
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$kname=explode('_',$this->Auth->user('id'));
	/*
			The important thing to note here is that there are THREE saves, in this order:
			$data is the CommentsUser data
			$commentdata is the Comment data ( just upvote and downvote tally right now)
			$votedata is the User vote tally, here we just track their grand total (it never subtracts)
			(hopefully all this painful counting will be worth it someday)
	
	*/
				//find the user rather than first method for proper vote totals
				//$user=$this->Auth->user();
			if ($kname[0]!='kiosk'){
				$user=$this->CommentsUser->User->find('first',array(
					'conditions'=>array('User.id'=>$this->Auth->user('id')),
					'recursive'=>-1	
				));
				$user=$user['User'];
				$is_kiosk='';
			}
			else{
				$user=$this->Auth->user();
				$user['id']=$user['id'].'_'.$this->request->data[$id]['time_stamp'];
				$is_kiosk=Configure::read('enableKioskMode');

			}
				$data['user_id']=$user['id'];
				$data['comment_id']=$id;
				$commentdata=$this->CommentsUser->Comment->find('first',array('recursive'=>-1,'conditions'=>array('Comment.id'=>$id)));
				$commentuser=$this->CommentsUser->find('first',array('conditions'=>array('CommentsUser.comment_id'=>$id,'CommentsUser.user_id'=>$user['id']),'recursive'=>-1));
				//first save user totals, they are simply cumulative
				//no, don't make a new user!
				//$this->CommentsUser->User->create();
				//need to fix this - don't save the User if Kiosk
				if ($kname[0]!='kiosk'){
				$votedata['id']=$this->Auth->user('id');
				if ($vote==1){
					$votedata['upvotes']=$user['upvotes'];
					$votedata['upvotes']++;
				}
				if ($vote==-1){
					$votedata['downvotes']=$user['downvotes'];
					$votedata['downvotes']++;
				}
					if ($this->CommentsUser->User->save($votedata,array('validate' => false)));
					
				}
					
				$this->CommentsUser->create();
				if(!empty($commentuser)){
					if ($vote==1 && $commentuser['CommentsUser']['upvoted']!=true){
						$data['id']=$commentuser['CommentsUser']['id'];
						//means we're reversing direction
						if ($commentuser['CommentsUser']['downvoted']==true){
							$data['upvoted']=false;
							$data['downvoted']=false;
							$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']-1;
							//$votedata['downvotes']=$votedata['downvotes']+1;
						}
						else {
							$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
							//$votedata['upvotes']=$votedata['upvotes']+1;
							unset($commentdata['Comment']['downvotes']);
							$data['upvoted']=true;
						}
					}
					else if ($vote==-1 && $commentuser['CommentsUser']['downvoted']!=true){
						$data['id']=$commentuser['CommentsUser']['id'];
							if ($commentuser['CommentsUser']['upvoted']==true){
								$data['upvoted']=false;
								$data['downvoted']=false;
								$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']-1;
								//$votedata['upvotes']=$votedata['upvotes']+1;
							}
							else {
								$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
								unset($commentdata['Comment']['upvotes']);
								$data['downvoted']=true;
							}
					}
					else {
						//they have already voted this way or something else is wrong
						return false;
					}
				}
				//comment is empty
				else {
					if ($vote==1){ 
						$data['upvoted']=true;
						$commentdata['Comment']['upvotes']=$commentdata['Comment']['upvotes']+1;
						unset($commentdata['Comment']['downvotes']);
					}
					if ($vote==-1){
						$data['downvoted']=1;
						$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']+1;
						unset($commentdata['Comment']['upvotes']);
					}
				}
				if($this->CommentsUser->save($data)){
					//update the actual comment with the new total
					$this->CommentsUser->Comment->create();
					$commentdata['Comment']['id']=$id;
					//debug($commentdata);
					if ($this->CommentsUser->Comment->save($commentdata['Comment'])){
						//run a quick query to update the difference
						$db = ConnectionManager::getDataSource('default');
						$db->rawQuery('update comments set diff=ifnull(upvotes,0)-ifnull(downvotes,0);');
					}
				}
					
			}
			else {
				$this->Session->setFlash('You must be logged in to upvote and downvote.','flash_custom',array(),'commentFlash');
				$user['id']=null;
				$is_kiosk='';
			}
			//return only the single comment
			$comment=$this->Comment->getComment($id,$user['id']);
			$js_time_stamp='';
			if (isset($this->request->data[$id]['time_stamp'])) $js_time_stamp=$this->request->data[$id]['time_stamp'];
			$this->set(compact('comment','user','is_kiosk','js_time_stamp'));
			$this->render('comment_single','ajax');
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

	//used for hiding or un-hiding comments via e-mail link
	public function secret_toggle($id, $secret) {
		$comment=$this->CommentsUser->Comment->find('first',array('conditions'=>array('Comment.id'=>$id,'Comment.secret_uuid'=>$secret),'fields'=>'Comment.*'));
		if (!$comment['Comment']['hidden']) $comment['Comment']['hidden']=true;
		else $comment['Comment']['hidden']=false;
		if ($this->CommentsUser->Comment->save($comment['Comment'])){
			echo 'HIDDEN = '.intval($comment['Comment']['hidden']);
		}
		//debug($comment);
		
		$this->autoRender = false;
	
	}
}

