<div class="stories form">
<?php echo $this->Form->create('Story'); ?>
	<fieldset id="story_form">
		<legend><?php echo __('Edit Story'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Editor->input('summary');
		echo $this->Editor->input('prologue');
		echo $this->Editor->input('epilogue');
		echo $this->Form->input('completed');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
	<h3 ><?php echo __('Chapters'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th></th>
			<th><?php echo __('Title'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($this->request->data['StoryChapter'] as $storyChapter): ?>
			<tr id="story_chapter_<?php echo $storyChapter['id']; ?>">
				<td><?php echo $storyChapter['chapter_number']; ?></td>
				<td><?php echo $this->Html->link($storyChapter['title'], array('controller' => 'story_chapters', 'action' => 'view', $storyChapter['story_id'], $storyChapter['id'])); ?></td>
				<td><?php echo $this->Html->link(__('Edit'), array('controller' => 'story_chapters', 'action' => 'edit', $storyChapter['story_id'], $storyChapter['id'])); ?>&nbsp;
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'story_chapters', 'action' => 'delete', $storyChapter['story_id'], $storyChapter['id']), null, __('Are you sure you want to delete # %s with its story?', $storyChapter['id'])); ?>	

			</tr>
		<?php endforeach; ?>
	</table>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add Chapter'), array('controller' => 'story_chapters', 'action' => 'add', $this->request->data['Story']['id'])); ?></li>
		<li><?php echo $this->Form->postLink(__('Delete Story'), array('action' => 'delete', $this->Form->value('Story.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Story.id'))); ?></li>
	</ul>
</div>
