<?php
App::uses('Story', 'Model');

/**
 * Story Test Case
 *
 */
class StoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story',
		'app.user',
		'app.user_setting',
		'app.user_contact',
		'app.user_profile',
		'app.user_group_association',
		'app.group',
		'app.chapter',
		'app.story_chapter'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Story = ClassRegistry::init('Story');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Story);

		parent::tearDown();
	}

}
