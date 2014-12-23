<?php
App::uses('AppController', 'Controller');

class CommentsUsersController extends AppController {

	public $components = array('Paginator','Comment');
	
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
						//call the component
						$comments=$this->Comment->getComments($templateid,$user['id']);
						$this->set(compact('comments','user'));
						$this->render('comment_add','ajax');
					}
				}
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
		//}
	}
	
	//$id is the id of the Template
	public function comment_add($id = null, $parentid=null) {
	//technically this should be on the Comment controller, as the junc table has nothing to do with add
	//but for now I just leave it..
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('Comment.template_id'=>$id,'Comment.user_id'=>$user['id'])
				));
				if (isset($commentdata['Comment']['id'])){
					$comment['id']=$commentdata['Comment']['id'];
				}
				else {
					$uuid=String::uuid();
					$comment['id']=$uuid;
				}
				$comment['thoughts']=$this->request->data['sComment']['comment'];
				if(isset($comment['rating'])) $comment['rating']=$this->request->data['sComment']['rating'];
				$comment['user_id']=$this->Auth->user('id');
				$comment['template_id']=$id;
				$comment['hidden']=0;
				if (isset($parentid)) $comment['parent_id']=$parentid;
				$this->CommentsUser->Comment->create();
				if ($this->CommentsUser->Comment->save($comment)){
					//Comment component..
					$comments=$this->Comment->getComments($id,$user['id']);
					$this->set(compact('comments','user'));
					$this->render('comment_add','ajax');
				}
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
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
				debug($user);
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
				//THIS IS WHERE I LEFT OFF
				// the problem is that Auth does not refresh on these Ajax calls, so it keeps getting set to null
				if(!empty($commentuser)){
					if ($vote==1 && $commentuser['CommentsUser']['upvoted']!=true){
						$data['id']=$commentuser['CommentsUser']['id'];
						//means we're reversing direction
						if ($commentuser['CommentsUser']['downvoted']==true){
							debug('subtract one');
							$data['upvoted']=false;
							$data['downvoted']=false;
							$commentdata['Comment']['downvotes']=$commentdata['Comment']['downvotes']-1;
							debug($user['downvotes']);
							$user['downvotes']=$user['downvotes']-1;
							debug($user['downvotes']);
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
								$user['downvotes']=$user['downvotes']+1;
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
						$user['upvotes']=$user['upvotes']+1;
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
					if ($this->CommentsUser->Comment->save($commentdata['Comment'])){
						$comments=$this->Comment->getComments($templateid,$user['id']);
						$this->set(compact('comments','user'));
						$this->render('comment_add','ajax');
						 //would save the counts here
						if ($this->CommentsUser->User->save($user)){
							//wow, it all went through... (and component call would be in here)
						}
						
					}

				}
					
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
		//}
	
	}
	
	//$id is the id of the comment
	public function comment_hide($id = null, $parentid=null) {
	//technically this should be on the Comment controller as well
	//be sure to turn this on in production
		//if ($this->request->is('ajax')){
			if ($this->Auth->user()){
				$user=$this->Auth->user();
				//first see if this is an existing comment and that it matches the logged in user
				$commentdata=$this->CommentsUser->Comment->find('first',array(
					'recursive'=>-1,
					'conditions'=>array('Comment.id'=>$id,'Comment.user_id'=>$user['id'])
				));
				if (isset($commentdata['Comment']['id'])){
					$commentdata['Comment']['hidden']=1;
					$this->CommentsUser->Comment->create();
					if ($this->CommentsUser->Comment->save($commentdata)){
						//Comment component
						$comments=$this->Comment->getComments($id,$user['id']);
						$this->set(compact('comments','user'));
						$this->render('comment_add','ajax');
					}
				}
				else {
					return true;
				}
				
			}
			else {
				echo 'you must be logged in to do this';
				$this->render(false,'ajax');
			}
		//}
	}	
	

	public function index() {
		$this->CommentsUser->recursive = 0;
		$this->set('commentsUsers', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->CommentsUser->exists($id)) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		$options = array('conditions' => array('CommentsUser.' . $this->CommentsUser->primaryKey => $id));
		$this->set('commentsUser', $this->CommentsUser->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->CommentsUser->create();
			if ($this->CommentsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The comments user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comments user could not be saved. Please, try again.'));
			}
		}
		$users = $this->CommentsUser->User->find('list');
		$comments = $this->CommentsUser->Comment->find('list');
		$this->set(compact('users', 'comments'));
	}

	public function edit($id = null) {
		if (!$this->CommentsUser->exists($id)) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CommentsUser->save($this->request->data)) {
				$this->Session->setFlash(__('The comments user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comments user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CommentsUser.' . $this->CommentsUser->primaryKey => $id));
			$this->request->data = $this->CommentsUser->find('first', $options);
		}
		$users = $this->CommentsUser->User->find('list');
		$comments = $this->CommentsUser->Comment->find('list');
		$this->set(compact('users', 'comments'));
	}

	public function delete($id = null) {
		$this->CommentsUser->id = $id;
		if (!$this->CommentsUser->exists()) {
			throw new NotFoundException(__('Invalid comments user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->CommentsUser->delete()) {
			$this->Session->setFlash(__('The comments user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The comments user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
