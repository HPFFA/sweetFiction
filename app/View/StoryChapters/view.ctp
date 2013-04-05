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
			<?php echo ($storyChapter['StoryChapter']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prologue'); ?></dt>
		<dd id="chapter_prologue">
			<?php echo ($storyChapter['StoryChapter']['prologue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd id="chapter_text">
			<?php echo ($storyChapter['StoryChapter']['text']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Epilogue'); ?></dt>
		<dd id="chapter_epilogue">
			<?php echo ($storyChapter['StoryChapter']['epilogue']); ?>
			&nbsp;
		</dd>
	</dl>
	<h3><?php echo __("Reviews"); ?></h3>
	<?php 
		echo $this->element("Review/review_tree", array(
			'reviews' => $reviews, 
			'is_author' => $this->Auth->user('id') == $story['Story']['user_id'],
			'reference_id' => $storyChapter['StoryChapter']['id'],
			'reference_type' => 'story_chapter')); ?>	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<?php if ($this->Auth->user() != null): ?>
		<li><?php echo $this->Html->link(__('Edit Story Chapter'), array('action' => 'edit', $storyChapter['StoryChapter']['story_id'], $storyChapter['StoryChapter']['id'])); ?> </li>
		<?php endif ?>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('action' => 'index', $storyChapter['StoryChapter']['story_id'], 'chapters', 'index')); ?> </li>
		<?php 
			$prev = $storyChapterNeighbours['prev'];
			if (!empty($prev)): ?>
			<li><?php echo $this->Html->link($prev['StoryChapter']['chapter_number'].'. '.h($prev['StoryChapter']['title']), array('controller' => 'story_chapters', 'action' => 'view', $story['Story']['id'], $prev['StoryChapter']['id'])); ?> </li>	
		<?php endif; 
			$next = $storyChapterNeighbours['next']; 
			if (!empty($next)): ?>
			<li><?php echo $this->Html->link($next['StoryChapter']['chapter_number'].'. '.h($next['StoryChapter']['title']), array('controller' => 'story_chapters', 'action' => 'view', $storyChapter['StoryChapter']['story_id'], $next['StoryChapter']['id'])); ?> </li>
		<?php endif; ?>
	</ul>
</div>
