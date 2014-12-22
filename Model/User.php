<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

	public $displayField = 'name';


// this is for comments the user makes
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

//and this is for the interaction the user has with comments
	
	public $hasAndBelongsToMany = array(
		'Comment' => array(
			'className' => 'User',
			'joinTable' => 'comments_users',
			'foreignKey' => 'comment_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
