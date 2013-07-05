<div class="stories index">
	<h2><?php echo __('Editorial - Stories'); ?></h2>
	<div class="sorting">
		<fieldset>
			<legend><?php echo __('Sort by Story'); ?></legend>
			<span><?php echo $this->Paginator->sort('Story.title', 'Title'); ?></span>&nbsp;
			<span><?php echo $this->Paginator->sort('Story.created', 'Created'); ?></span>&nbsp;
			<span><?php echo $this->Paginator->sort('Story.updated', 'Updated'); ?></span>&nbsp;
		</fieldset>
		<fieldset>
			<legend><?php echo __('Sort by Chapter'); ?></legend>
			<span><?php echo $this->Paginator->sort('StoryChapter.title', 'Title'); ?></span>&nbsp;
			<span><?php echo $this->Paginator->sort('StoryChapter.created', 'Created'); ?></span>&nbsp;
			<span><?php echo $this->Paginator->sort('StoryChapter.updated', 'Updated'); ?></span>&nbsp;
		</fieldset>
		<fieldset>
			<legend><?php echo __('Sort by User'); ?></legend>
			<span><?php echo $this->Paginator->sort('User.name', 'Author'); ?></span>&nbsp;
			<span><?php echo $this->Paginator->sort('Editor.name', 'Editor'); ?></span>&nbsp;
		</fieldset>	
	</div>
	
	<?php for ($i = 0; $i < sizeof($editorials); $i++):
		$editorial = $editorials[$i]; 
		if ($i == 0 || $editorials[$i - 1]['Story']['id'] != $editorial['Story']['id']): 
			$html_story_id = 'story_'.$editorial['Story']['id']; ?>
			<div class="story_description" id="<?php echo $html_story_id; ?>">
				<div>
					<?php 
			            $title = '<span class="story_title">'.$this->Html->link($editorial['Story']['title'], array('controller' => 'editorials', 'action' => 'view', 'story', $editorial['Story']['id'])).'</span>';
			            $author = '<span class="story_author">'.$this->Html->link($editorial['User']['name'], array('controller' => 'users', 'action' => 'view', $editorial['User']['id'])).'</span>';
			            echo __('%s by %s', $title, $author);
			        ?>
			        <?php if ($editorial['Story']['completed']): ?>
			            <span class="completed"><?php echo __('Completed'); ?></span>
			        <?php endif; ?>
			    </div>
			    <div class="small_font">
			    	<?php echo __("Created") ?>: <?php echo $editorial['Story']['created'] ?> | 
			    	<?php echo __("Updated") ?>: <?php echo $editorial['Story']['updated'] ?>
			    </div>
			    <div class="unvalided"><h4><?php echo __('Unvalidated chapters'); ?>:<h4>
			    	<ul>
		<?php endif ?>
						<li>
							<div>
		    					<?php echo $this->Html->link($editorial['StoryChapter']['chapter_number'].'. '.$editorial['StoryChapter']['title'], array('controller' => 'editorials', 'action' => 'view', 'story_chapter', $editorial['StoryChapter']['id'])); ?>
		    					<span class="small_font">
							    	<?php echo __("Created") ?>: <?php echo $editorial['StoryChapter']['created'] ?> | 
							    	<?php echo __("Updated") ?>: <?php echo $editorial['StoryChapter']['updated'] ?>
							    </span>
							</div>
							<div>
						    	<span class="editor">
						    		<?php echo __("Editor") ?>: <?php echo $this->Html->link($editorial['Editor']['name'], array('controller' => 'users', 'action' => 'view', $editorial['Editor']['id'])) ?>
						    	</span>
						    	<span class="small_font">
							    	<?php echo __("Created") ?>: <?php echo $editorial['Editorial']['created'] ?> | 
							    	<?php echo __("Updated") ?>: <?php echo $editorial['Editorial']['updated'] ?>
							    </span>
						   	</div>
						</li>
		<?php if ($i == sizeof($editorials) -1 || $editorial['Story']['id'] != $editorials[$i + 1]['Story']['id']): ?>
					</ul>
				</div>
			</div>
		<?php endif ?>
	<?php endfor ?>

	<p>
		<?php
			echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
		?>	
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
