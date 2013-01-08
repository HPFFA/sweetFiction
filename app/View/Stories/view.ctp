<div class="stories view">
<h2 id="story_title"><?php echo h($story['Story']['title']); ?></h2>
	<dl>
		<dt><?php echo __('Author'); ?></dt>
		<dd id="story_author">
			<?php echo $this->Html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id'])); ?>
			&nbsp;
		</dd>
		<?php if ($story['Story']['completed']): ?>
			<dt><?php echo __('Completed'); ?></dt>
			<dd id="story_completed">
				<?php echo __("Completed"); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<dt><?php echo __('Summary'); ?></dt>
		<dd id="story_summary">
			<?php echo h($story['Story']['summary']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prologue'); ?></dt>
		<dd id="story_prologue">
			<?php echo h($story['Story']['prologue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Epilogue'); ?></dt>
		<dd id="story_epilogue">
			<?php echo h($story['Story']['epilogue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd id="story_updated">
			<?php echo h($story['Story']['updated']); ?>
			&nbsp;
		</dd>
	</dl>

	<h3 ><?php echo __('Chapters'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th></th>
			<th><?php echo __('Title'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($story['StoryChapter'] as $storyChapter): ?>
			<tr id="story_chapter_<?php echo $storyChapter['id']; ?>">
				<td><?php echo $storyChapter['chapter_number']; ?></td>
				<td><?php echo $this->Html->link($storyChapter['title'], array('controller' => 'story_chapters', 'action' => 'view', $storyChapter['id'])); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
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
		<li><?php echo $this->Html->link(__('Add Chapter'), array('controller' => 'stories', 'action' => 'edit', $story['Story']['id'], 'chapters', 'add' )); ?> </li>
	</ul>
</div>
<div class="related">
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
