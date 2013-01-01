<?php
App::uses('StoryChapter', 'Model');

/**
 * StoryChapter Test Case
 *
 */
class StoryChapterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.story_chapter',
		'app.user',
		'app.user_setting',
		'app.user_contact',
		'app.user_profile',
		'app.user_group_association',
		'app.group',
		'app.story',
		'app.chapter'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StoryChapter = ClassRegistry::init('StoryChapter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StoryChapter);

		parent::tearDown();
	}

}
