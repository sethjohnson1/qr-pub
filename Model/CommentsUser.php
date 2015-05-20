<?php
App::uses('AppModel', 'Model');
/**
 * CommentsUser Model
 *
 * @property User $User
 * @property Comment $Comment
 */
class CommentsUser extends AppModel {


	public $displayField = 'user_id';


	
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
