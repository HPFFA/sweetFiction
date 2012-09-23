<?php
App::uses('UserContact', 'Model');

/**
 * UserContact Test Case
 *
 */
class UserContactTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_contact',
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
		$this->UserContact = ClassRegistry::init('UserContact');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserContact);

		parent::tearDown();
	}

}
