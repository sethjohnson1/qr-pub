<?php
App::uses('Internship', 'Model');

/**
 * Internship Test Case
 *
 */
class InternshipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.internship',
		'app.user',
		'app.tag',
		'app.internships_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Internship = ClassRegistry::init('Internship');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Internship);

		parent::tearDown();
	}

}
