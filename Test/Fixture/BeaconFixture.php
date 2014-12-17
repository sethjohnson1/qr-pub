<?php
/**
 * BeaconFixture
 *
 */
class BeaconFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'active' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'uuid' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'major' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'minor' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'strength' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'museum' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'template_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-11-27 06:23:06',
			'modified' => '2014-11-27 06:23:06',
			'active' => 1,
			'uuid' => 'Lorem ipsum dolor sit amet',
			'major' => 1,
			'minor' => 1,
			'strength' => 1,
			'museum' => 'Lorem ip',
			'template_id' => 1
		),
	);

}
