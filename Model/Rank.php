<?php
App::uses('AppModel', 'Model');

class Rank extends AppModel {

	public $displayField = 'name';
	
		public $actsAs = array('Search.Searchable');
		public $filterArgs = array(
			'searchdata'=>array('type' => 'like','field'=>array(
				'Rank.name'
				,'Rank.quote'
				,'Rank.ranktype'
				,'Rank.rankvalue'
			))
		);

}
