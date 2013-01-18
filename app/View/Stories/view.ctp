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
		<?php foreach ($storyChapters as $storyChapter): ?>
			<tr class="story_chapter" id="story_chapter_<?php echo $storyChapter['StoryChapter']['id'];?>">
				<td><?php echo $storyChapter['StoryChapter']['chapter_number']; ?></td>
				<td>
					<?php
						echo $this->element('Story/chapter_description', array(
						'story' => $story['Story'],
						'chapter' => $storyChapter['StoryChapter'],
						'user' => $storyChapter['User'])); 
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</table>
	<h3><?php echo __("Reviews"); ?></h3>
	<?php echo $this->element("Review/review_tree", array(
			'reviews' => $reviews, 
			'is_author' => $this->Auth->user('id') == $story['Story']['user_id'],
			'reference_id' => $story['Story']['id'],
			'reference_type' => 'story')); ?>	
</div>

<?php if ($this->Auth->user('id') == $story['Story']['user_id']): ?>
	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('Edit Story'), array('action' => 'edit', $story['Story']['id'])); ?> </li>
		</ul>
	</div>
<?php endif; ?>