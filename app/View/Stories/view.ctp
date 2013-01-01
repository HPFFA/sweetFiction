<div class="stories view">
<h2><?php  echo __('Story'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($story['Story']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($story['Story']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php echo h($story['Story']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prologue'); ?></dt>
		<dd>
			<?php echo h($story['Story']['prologue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Epilogue'); ?></dt>
		<dd>
			<?php echo h($story['Story']['epilogue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed'); ?></dt>
		<dd>
			<?php echo h($story['Story']['completed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($story['Story']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($story['Story']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($story['Story']['deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Story'), array('action' => 'edit', $story['Story']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Story'), array('action' => 'delete', $story['Story']['id']), null, __('Are you sure you want to delete # %s?', $story['Story']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('controller' => 'story_chapters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Story Chapters'); ?></h3>
	<?php if (!empty($story['StoryChapter'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Story Id'); ?></th>
		<th><?php echo __('Chapter Number'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('Prelogue'); ?></th>
		<th><?php echo __('Epilogue'); ?></th>
		<th><?php echo __('Text'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($story['StoryChapter'] as $storyChapter): ?>
		<tr>
			<td><?php echo $storyChapter['id']; ?></td>
			<td><?php echo $storyChapter['user_id']; ?></td>
			<td><?php echo $storyChapter['story_id']; ?></td>
			<td><?php echo $storyChapter['chapter_number']; ?></td>
			<td><?php echo $storyChapter['title']; ?></td>
			<td><?php echo $storyChapter['remarks']; ?></td>
			<td><?php echo $storyChapter['prelogue']; ?></td>
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
