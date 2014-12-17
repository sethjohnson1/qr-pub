<?php
App::uses('Preference', 'Model');

/**
 * Preference Test Case
 *
 */
class PreferenceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.preference'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Preference = ClassRegistry::init('Preference');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Preference);

		parent::tearDown();
	}

}
