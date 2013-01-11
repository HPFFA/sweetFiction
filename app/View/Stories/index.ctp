<div class="stories index">
	<h2><?php echo __('Stories'); ?></h2>
	<div class="sorting">
		<h4><?php echo __('Sorting'); ?></h4>
		<span><?php echo $this->Paginator->sort('title'); ?></span>&nbsp;
		<span><?php echo $this->Paginator->sort('user_id'); ?></span>&nbsp;
		<span><?php echo $this->Paginator->sort('completed'); ?></span>&nbsp;
		<span><?php echo $this->Paginator->sort('updated'); ?></span>
	</div>

	<?php foreach ($stories as $story): 
		$html_story_id = 'story_'.$story['Story']['id'];
		?>
		<div class="story_description" id="<?php echo $html_story_id; ?>">
			<div>
				<?php 
					$title = '<span class="story_title">'.$this->Html->link($story['Story']['title'], array('action' => 'view', $story['Story']['id'])).'</span>';
					$author = '<span class="story_author">'.$this->Html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id'])).'</span>';
					echo __('%s by %s', $title, $author);
				?>
				<span class="small_font">(<?php echo h($story['Story']['updated']); ?>)</span>
				<?php if ($story['Story']['completed']): ?>
					<span class="completed"><?php echo __('Completed'); ?></span>
				<?php endif; ?>
			</div>
			<span class="story_summary"><?php echo h($story['Story']['summary']); ?></span>
		</div>
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
