<div class="storyChapters index">
	<h2><?php echo __('Story Chapters'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('story_id'); ?></th>
			<th><?php echo $this->Paginator->sort('chapter_number'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('remarks'); ?></th>
			<th><?php echo $this->Paginator->sort('prologue'); ?></th>
			<th><?php echo $this->Paginator->sort('epilogue'); ?></th>
			<th><?php echo $this->Paginator->sort('text'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('deleted'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($storyChapters as $storyChapter): ?>
	<tr>
		<td><?php echo h($storyChapter['StoryChapter']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($storyChapter['User']['name'], array('controller' => 'users', 'action' => 'view', $storyChapter['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($storyChapter['Story']['title'], array('controller' => 'stories', 'action' => 'view', $storyChapter['Story']['id'])); ?>
		</td>
		<td><?php echo h($storyChapter['StoryChapter']['chapter_number']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['title']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['remarks']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['prologue']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['epilogue']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['text']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['created']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['updated']); ?>&nbsp;</td>
		<td><?php echo h($storyChapter['StoryChapter']['deleted']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $storyChapter['StoryChapter']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $storyChapter['StoryChapter']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $storyChapter['StoryChapter']['id']), null, __('Are you sure you want to delete # %s?', $storyChapter['StoryChapter']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
	</ul>
</div>
