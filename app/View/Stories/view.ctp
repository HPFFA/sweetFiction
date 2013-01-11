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
		<?php endif;
			if (!empty($story['Story']['summary'])): ?>
			<dt><?php echo __('Summary'); ?></dt>
			<dd id="story_summary">
				<?php echo h($story['Story']['summary']); ?>
				&nbsp;
			</dd>
		<?php endif; 
			if (!empty($story['Story']['prologue'])): ?>
			<dt><?php echo __('Prologue'); ?></dt>
			<dd id="story_prologue">
				<?php echo h($story['Story']['prologue']); ?>
				&nbsp;
			</dd>
		<?php endif;
			if (!empty($story['Story']['prologue'])): ?>
			<dt><?php echo __('Epilogue'); ?></dt>
			<dd id="story_epilogue">
				<?php echo h($story['Story']['epilogue']); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
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
			<tr class="story_chapter" id="story_chapter_<?php echo $storyChapter['id']; ?>">
				<td><?php echo $storyChapter['chapter_number']; ?></td>
				<td><?php echo $this->Html->link($storyChapter['title'], array('controller' => 'stories', 'action' => 'view', $story['Story']['id'], 'chapters', 'view', $storyChapter['id'])); ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php if ($this->Auth->user('id') == $story['Story']['user_id']): ?>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Story'), array('action' => 'edit', $story['Story']['id'])); ?> </li>
		</ul>
	</div>
<?php endif; ?>