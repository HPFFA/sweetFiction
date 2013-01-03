<div class="stories form">
	<?php echo $this->Form->create('Story'); ?>
	<fieldset id="story_form">
		<legend><?php echo __('Story'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('summary');
			echo $this->Form->input('prologue');
			echo $this->Form->input('epilogue');
		?>
	</fieldset>
	<fieldset id="chapter_form">
		<legend><?php echo __('Chapter'); ?></legend>
		<?php
			echo $this->Form->input('StoryChapter.title');
			echo $this->Form->input('StoryChapter.remarks');
			echo $this->Form->input('StoryChapter.prologue');
			echo $this->Form->input('StoryChapter.text');
			echo $this->Form->input('StoryChapter.epilogue');
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
