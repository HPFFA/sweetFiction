<div class="storyChapters view">
	<h2><?php 
	        $title = '<span class="story_title">'.$this->Html->link($story['Story']['title'], array('controller' => 'stories', 'action' => 'view', $story['Story']['id'])).'</span>';
	        $author = '<span class="story_author">'.$this->Html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id'])).'</span>';
	        echo __('%s by %s', $title, $author);
	    ?>
	</h2>
	<h3>
	<span id="chapter_number"><?php echo $storyChapter['StoryChapter']['chapter_number']; ?></span>. <span id="chapter_title"><?php echo h($storyChapter['StoryChapter']['title']); ?></span></h3>
	<dl>
		<?php if ($story['Story']['user_id'] != $storyChapter['StoryChapter']['user_id']): ?>
			<dt><?php echo __('User'); ?></dt>
			<dd id="chapter_author">
				<?php echo $this->Html->link($storyChapter['User']['name'], array('controller' => 'users', 'action' => 'view', $storyChapter['User']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
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
		<li><?php echo $this->Html->link(__('Edit Story Chapter'), array('action' => 'edit', $storyChapter['StoryChapter']['story_id'], 'chapters', 'edit', $storyChapter['StoryChapter']['id'])); ?> </li>
		
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index', $storyChapter['StoryChapter']['story_id'], 'chapters', 'index')); ?> </li>
		<?php 
			$prev = $storyChapterNeighbours['prev'];
			if (!empty($prev)): ?>
			<li><?php echo $this->Html->link($prev['StoryChapter']['chapter_number'].'. '.h($prev['StoryChapter']['title']), array('controller' => 'stories', 'action' => 'view', $story['Story']['id'], 'chapters', 'view', $prev['StoryChapter']['id'])); ?> </li>	
		<?php endif; 
			$next = $storyChapterNeighbours['next']; 
			if (!empty($next)): ?>
			<li><?php echo $this->Html->link($next['StoryChapter']['chapter_number'].'. '.h($next['StoryChapter']['title']), array('controller' => 'stories', 'action' => 'view', $storyChapter['StoryChapter']['story_id'], 'chapters', 'view', $next['StoryChapter']['id'])); ?> </li>
		<?php endif; ?>
		
	</ul>
</div>
