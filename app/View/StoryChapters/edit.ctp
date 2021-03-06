<div class="storyChapters form">
<?php echo $this->Form->create('StoryChapter'); ?>
	<fieldset id="story_form">
		<legend><?php echo __('Story'); ?></legend>
		<?php
			echo $this->Form->input('Story.completed', array('type' => 'checkbox'));
		?>
	</fieldset>
	<fieldset id="chapter_form">
		<legend><?php echo __('Story Chapter'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Editor->input('remarks');
		echo $this->Editor->input('prologue');
		echo $this->Editor->input('text');
		echo $this->Editor->input('epilogue');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StoryChapter.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StoryChapter.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index', $this->Form->value('StoryChapter.story_id'), 'chapters', 'index')); ?></li>
	</ul>
</div>
