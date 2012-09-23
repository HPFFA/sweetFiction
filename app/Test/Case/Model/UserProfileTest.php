<?php
App::uses('UserProfile', 'Model');

/**
 * UserProfile Test Case
 *
 */
class UserProfileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_profile',
		'app.user',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserProfile = ClassRegistry::init('UserProfile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserProfile);

		parent::tearDown();
	}

}
