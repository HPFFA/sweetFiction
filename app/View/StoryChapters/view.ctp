<div class="storyChapters view">
<h2 id="story_title"><?php echo $this->Html->link($storyChapter['Story']['title'], array('controller' => 'stories', 'action' => 'view', $storyChapter['Story']['id'])); ?></h2> 
<h3><span id="chapter_number"><?php echo h($storyChapter['StoryChapter']['chapter_number']); ?></span>. <span id="chapter_title"><?php echo h($storyChapter['StoryChapter']['title']); ?></span></h3>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($storyChapter['StoryChapter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd id="chapter_author">
			<?php echo $this->Html->link($storyChapter['User']['name'], array('controller' => 'users', 'action' => 'view', $storyChapter['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd id="chapter_remarks">
			<?php echo h($storyChapter['StoryChapter']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prologue'); ?></dt>
		<dd id="chapter_prologue">
			<?php echo h($storyChapter['StoryChapter']['prologue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd id="chapter_text">
			<?php echo h($storyChapter['StoryChapter']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Epilogue'); ?></dt>
		<dd id="chapter_epilogue">
			<?php echo h($storyChapter['StoryChapter']['epilogue']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Story Chapter'), array('action' => 'edit', $storyChapter['StoryChapter']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Story Chapter'), array('action' => 'delete', $storyChapter['StoryChapter']['id']), null, __('Are you sure you want to delete # %s?', $storyChapter['StoryChapter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
	</ul>
</div>
