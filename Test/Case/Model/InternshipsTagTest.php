<?php
App::uses('InternshipsTag', 'Model');

/**
 * InternshipsTag Test Case
 *
 */
class InternshipsTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.internships_tag',
		'app.internship',
		'app.user',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InternshipsTag = ClassRegistry::init('InternshipsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InternshipsTag);

		parent::tearDown();
	}

}
