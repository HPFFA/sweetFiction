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
		$html_story_id = 'story_'.$story['Story']['id']; ?>
		<div class="story_description" id="<?php echo $html_story_id; ?>">
			<?php 
				echo $this->element('Story/description', array(
					'story' => $story['Story'], 
					'user' => $story['User'])); 
			?>
		</div>
	<?php endforeach; ?>
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
