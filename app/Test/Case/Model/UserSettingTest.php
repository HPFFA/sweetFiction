<?php
App::uses('UserSetting', 'Model');

/**
 * UserSetting Test Case
 *
 */
class UserSettingTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_setting',
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
		$this->UserSetting = ClassRegistry::init('UserSetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserSetting);

		parent::tearDown();
	}

}
