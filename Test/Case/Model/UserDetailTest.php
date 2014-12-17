<?php
App::uses('UserDetail', 'Model');

/**
 * UserDetail Test Case
 *
 */
class UserDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_detail',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserDetail = ClassRegistry::init('UserDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserDetail);

		parent::tearDown();
	}

}
