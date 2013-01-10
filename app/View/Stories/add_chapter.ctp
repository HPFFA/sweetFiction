<div class="storyChapters form">
<?php echo $this->Form->create('StoryChapter'); ?>
	<fieldset id="story_form">
		<legend><?php echo __('Story'); ?></legend>
		<?php
			echo $this->Form->input('Story.completed', array('type' => 'checkbox'));
		?>
	</fieldset>
	<fieldset id="chapter_form">
		<legend><?php echo __('Add Story Chapter'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('remarks');
		echo $this->Form->input('prologue');
		echo $this->Form->input('text');
		echo $this->Form->input('epilogue');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
	</ul>
</div>
