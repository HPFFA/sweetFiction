<div class="stories form">
	<?php echo $this->Form->create('Story'); ?>
	<fieldset id="story_form">
		<legend><?php echo __('Story'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Editor->input('summary');
			echo $this->Editor->input('prologue');
			echo $this->Editor->input('epilogue');
			echo $this->Form->input('completed');
		?>
	</fieldset>
	<fieldset id="chapter_form">
		<legend><?php echo __('Chapter'); ?></legend>
		<?php
			echo $this->Form->input('StoryChapter.0.title');
			echo $this->Editor->input('StoryChapter.0.remarks');
			echo $this->Editor->input('StoryChapter.0.prologue');
			echo $this->Editor->input('StoryChapter.0.text');
			echo $this->Editor->input('StoryChapter.0.epilogue');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Stories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('controller' => 'story_chapters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
	</ul>
</div>
