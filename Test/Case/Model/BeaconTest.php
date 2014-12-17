<?php
App::uses('Beacon', 'Model');

/**
 * Beacon Test Case
 *
 */
class BeaconTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.beacon',
		'app.template',
		'app.asset'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Beacon = ClassRegistry::init('Beacon');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Beacon);

		parent::tearDown();
	}

}
