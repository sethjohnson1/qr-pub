<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 */
class Comment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'thoughts';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Template' => array(
			'className' => 'Template',
			'foreignKey' => 'template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User',
			'joinTable' => 'comments_users',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'comment_id',
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
