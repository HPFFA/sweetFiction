<div class="editorial stories view">
<h2 id="story_title"><?php echo h($story['Story']['title']); ?></h2>
    <dl>
        <dt><?php echo __('Author'); ?></dt>
        <dd id="story_author">
            <?php echo $this->Html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Completed'); ?></dt>
        <dd id="story_completed">
            <?php echo $story['Story']['completed'] ? __("Completed") : __("Not completed"); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Summary'); ?></dt>
        <dd id="story_summary">
            <?php echo ($story['Story']['summary']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Prologue'); ?></dt>
        <dd id="story_prologue">
            <?php echo ($story['Story']['prologue']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Epilogue'); ?></dt>
        <dd id="story_epilogue">
            <?php echo ($story['Story']['epilogue']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd id="story_created">
            <?php echo h($story['Story']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Updated'); ?></dt>
        <dd id="story_updated">
            <?php echo h($story['Story']['updated']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Published'); ?></dt>
        <dd id="story_published">
            <?php echo h($story['Story']['published']); ?>
            &nbsp;
        </dd>
    </dl>
    
    <h3 ><?php echo __('Chapters'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th></th>
            <th><?php echo __('Title'); ?></th>
            <th></th>
        </tr>
        <?php foreach ($storyChapters as $storyChapter): ?>
            <tr class="story_chapter" id="story_chapter_<?php echo $storyChapter['StoryChapter']['id'];?>">
                <td><?php echo $storyChapter['StoryChapter']['chapter_number']; ?></td>
                <td>
<div>
                                <?php 
                                echo $this->Html->link($storyChapter['StoryChapter']['chapter_number'].'. '.$storyChapter['StoryChapter']['title'], array('controller' => 'editorials', 'action' => 'view', 'story_chapter', $storyChapter['StoryChapter']['id'])); ?>
                                <span class="small_font">
                                    <?php echo __("Created") ?>: <?php echo $storyChapter['StoryChapter']['created'] ?> | 
                                    <?php echo __("Updated") ?>: <?php echo $storyChapter['StoryChapter']['updated'] ?>
                                </span>
                            </div>
                            <div>
                                <span class="editor">
                                    <?php echo __("Editor") ?>: <?php echo $this->Html->link($storyChapter['Editor']['name'], array('controller' => 'users', 'action' => 'view', $storyChapter['Editor']['id'])) ?>
                                </span>
                                <span class="small_font">
                                    <?php echo __("Created") ?>: <?php echo $storyChapter['Editorial']['created'] ?> | 
                                    <?php echo __("Updated") ?>: <?php echo $storyChapter['Editorial']['updated'] ?>
                                </span>
                            </div>
                </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Take'), array('action' => 'take_chapter', $storyChapter['StoryChapter']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit_chapter', $storyChapter['StoryChapter']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        
    </table>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit_story', $story['Story']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Take'), array('action' => 'take_story', $story['Story']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Publish'), array('action' => 'publish_story', $story['Story']['id'])); ?></li>
        <li><?php echo $this->Html->link(__('Add Chapter'), array('controller' => 'story_chapters', 'action' => 'add', $story['Story']['id'])); ?></li>
        <li><?php echo $this->Form->postLink(__('Delete Story'), array('action' => 'delete', $story['Story']['id']), null, __('Are you sure you want to delete "%s"?', $story['Story']['title'])); ?></li>
    </ul>
</div>
