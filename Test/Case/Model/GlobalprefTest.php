<?php
App::uses('Globalpref', 'Model');

/**
 * Globalpref Test Case
 *
 */
class GlobalprefTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.globalpref'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Globalpref = ClassRegistry::init('Globalpref');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Globalpref);

		parent::tearDown();
	}

}
