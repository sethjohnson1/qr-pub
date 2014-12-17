<?php
App::uses('InternsTag', 'Model');

/**
 * InternsTag Test Case
 *
 */
class InternsTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.interns_tag',
		'app.intern',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InternsTag = ClassRegistry::init('InternsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InternsTag);

		parent::tearDown();
	}

}
