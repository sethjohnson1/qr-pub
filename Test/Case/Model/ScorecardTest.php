<?php
App::uses('Scorecard', 'Model');

/**
 * Scorecard Test Case
 *
 */
class ScorecardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.scorecard',
		'app.user',
		'app.comment',
		'app.comments_user',
		'app.template',
		'app.asset',
		'app.beacon'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Scorecard = ClassRegistry::init('Scorecard');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Scorecard);

		parent::tearDown();
	}

}
