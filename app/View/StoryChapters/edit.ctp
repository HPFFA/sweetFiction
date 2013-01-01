<div class="storyChapters form">
<?php echo $this->Form->create('StoryChapter'); ?>
	<fieldset>
		<legend><?php echo __('Edit Story Chapter'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('story_id');
		echo $this->Form->input('chapter_number');
		echo $this->Form->input('title');
		echo $this->Form->input('remarks');
		echo $this->Form->input('prelogue');
		echo $this->Form->input('epilogue');
		echo $this->Form->input('text');
		echo $this->Form->input('deleted');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('StoryChapter.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('StoryChapter.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
	</ul>
</div>
