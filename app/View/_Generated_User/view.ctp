<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($user['User']['state']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Settings'), array('controller' => 'user_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Setting'), array('controller' => 'user_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Contacts'), array('controller' => 'user_contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Contact'), array('controller' => 'user_contacts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Profiles'), array('controller' => 'user_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Profile'), array('controller' => 'user_profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Group Associations'), array('controller' => 'user_group_associations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Associations'), array('controller' => 'user_group_associations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('controller' => 'story_chapters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related User Settings'); ?></h3>
	<?php if (!empty($user['UserSetting'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['UserSetting']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['UserSetting']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Notify For Favorites'); ?></dt>
		<dd>
	<?php echo $user['UserSetting']['notify_for_favorites']; ?>
&nbsp;</dd>
		<dt><?php echo __('Notify For Reviews'); ?></dt>
		<dd>
	<?php echo $user['UserSetting']['notify_for_reviews']; ?>
&nbsp;</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
	<?php echo $user['UserSetting']['updated']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User Setting'), array('controller' => 'user_settings', 'action' => 'edit', $user['UserSetting']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related User Contacts'); ?></h3>
	<?php if (!empty($user['UserContact'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Homepage'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['homepage']; ?>
&nbsp;</dd>
		<dt><?php echo __('Public Email'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['public_email']; ?>
&nbsp;</dd>
		<dt><?php echo __('Icq'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['icq']; ?>
&nbsp;</dd>
		<dt><?php echo __('Yahoo'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['yahoo']; ?>
&nbsp;</dd>
		<dt><?php echo __('Msn'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['msn']; ?>
&nbsp;</dd>
		<dt><?php echo __('Skype'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['skype']; ?>
&nbsp;</dd>
		<dt><?php echo __('Aol'); ?></dt>
		<dd>
	<?php echo $user['UserContact']['aol']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User Contact'), array('controller' => 'user_contacts', 'action' => 'edit', $user['UserContact']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related User Profiles'); ?></h3>
	<?php if (!empty($user['UserProfile'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['UserProfile']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['UserProfile']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Real Name'); ?></dt>
		<dd>
	<?php echo $user['UserProfile']['real_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
	<?php echo $user['UserProfile']['birthday']; ?>
&nbsp;</dd>
		<dt><?php echo __('Biography'); ?></dt>
		<dd>
	<?php echo $user['UserProfile']['biography']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit User Profile'), array('controller' => 'user_profiles', 'action' => 'edit', $user['UserProfile']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related User Group Associations'); ?></h3>
	<?php if (!empty($user['GroupAssociations'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['GroupAssociations'] as $groupAssociations): ?>
		<tr>
			<td><?php echo $groupAssociations['group_id']; ?></td>
			<td><?php echo $groupAssociations['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_group_associations', 'action' => 'view', $groupAssociations['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_group_associations', 'action' => 'edit', $groupAssociations['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_group_associations', 'action' => 'delete', $groupAssociations['id']), null, __('Are you sure you want to delete # %s?', $groupAssociations['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group Associations'), array('controller' => 'user_group_associations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Stories'); ?></h3>
	<?php if (!empty($user['Story'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Prologue'); ?></th>
		<th><?php echo __('Epilogue'); ?></th>
		<th><?php echo __('Completed'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Story'] as $story): ?>
		<tr>
			<td><?php echo $story['id']; ?></td>
			<td><?php echo $story['user_id']; ?></td>
			<td><?php echo $story['title']; ?></td>
			<td><?php echo $story['summary']; ?></td>
			<td><?php echo $story['prologue']; ?></td>
			<td><?php echo $story['epilogue']; ?></td>
			<td><?php echo $story['completed']; ?></td>
			<td><?php echo $story['created']; ?></td>
			<td><?php echo $story['updated']; ?></td>
			<td><?php echo $story['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'stories', 'action' => 'view', $story['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'stories', 'action' => 'edit', $story['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'stories', 'action' => 'delete', $story['id']), null, __('Are you sure you want to delete # %s?', $story['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Story Chapters'); ?></h3>
	<?php if (!empty($user['StoryChapter'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Story Id'); ?></th>
		<th><?php echo __('Chapter Number'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('Prologue'); ?></th>
		<th><?php echo __('Epilogue'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['StoryChapter'] as $storyChapter): ?>
		<tr>
			<td><?php echo $storyChapter['id']; ?></td>
			<td><?php echo $storyChapter['user_id']; ?></td>
			<td><?php echo $storyChapter['story_id']; ?></td>
			<td><?php echo $storyChapter['chapter_number']; ?></td>
			<td><?php echo $storyChapter['title']; ?></td>
			<td><?php echo $storyChapter['remarks']; ?></td>
			<td><?php echo $storyChapter['prologue']; ?></td>
			<td><?php echo $storyChapter['epilogue']; ?></td>
			<td><?php echo $storyChapter['text']; ?></td>
			<td><?php echo $storyChapter['created']; ?></td>
			<td><?php echo $storyChapter['updated']; ?></td>
			<td><?php echo $storyChapter['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'story_chapters', 'action' => 'view', $storyChapter['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'story_chapters', 'action' => 'edit', $storyChapter['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'story_chapters', 'action' => 'delete', $storyChapter['id']), null, __('Are you sure you want to delete # %s?', $storyChapter['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Reviews'); ?></h3>
	<?php if (!empty($user['StoryReview'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Reference Id'); ?></th>
		<th><?php echo __('Reference Type'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('User Name'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['StoryReview'] as $storyReview): ?>
		<tr>
			<td><?php echo $storyReview['id']; ?></td>
			<td><?php echo $storyReview['parent_id']; ?></td>
			<td><?php echo $storyReview['reference_id']; ?></td>
			<td><?php echo $storyReview['reference_type']; ?></td>
			<td><?php echo $storyReview['user_id']; ?></td>
			<td><?php echo $storyReview['user_name']; ?></td>
			<td><?php echo $storyReview['text']; ?></td>
			<td><?php echo $storyReview['state']; ?></td>
			<td><?php echo $storyReview['created']; ?></td>
			<td><?php echo $storyReview['updated']; ?></td>
			<td><?php echo $storyReview['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'reviews', 'action' => 'view', $storyReview['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'reviews', 'action' => 'edit', $storyReview['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reviews', 'action' => 'delete', $storyReview['id']), null, __('Are you sure you want to delete # %s?', $storyReview['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Reviews'); ?></h3>
	<?php if (!empty($user['StoryChapterReview'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Reference Id'); ?></th>
		<th><?php echo __('Reference Type'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('User Name'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['StoryChapterReview'] as $storyChapterReview): ?>
		<tr>
			<td><?php echo $storyChapterReview['id']; ?></td>
			<td><?php echo $storyChapterReview['parent_id']; ?></td>
			<td><?php echo $storyChapterReview['reference_id']; ?></td>
			<td><?php echo $storyChapterReview['reference_type']; ?></td>
			<td><?php echo $storyChapterReview['user_id']; ?></td>
			<td><?php echo $storyChapterReview['user_name']; ?></td>
			<td><?php echo $storyChapterReview['text']; ?></td>
			<td><?php echo $storyChapterReview['state']; ?></td>
			<td><?php echo $storyChapterReview['created']; ?></td>
			<td><?php echo $storyChapterReview['updated']; ?></td>
			<td><?php echo $storyChapterReview['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'reviews', 'action' => 'view', $storyChapterReview['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'reviews', 'action' => 'edit', $storyChapterReview['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reviews', 'action' => 'delete', $storyChapterReview['id']), null, __('Are you sure you want to delete # %s?', $storyChapterReview['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story Chapter Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
