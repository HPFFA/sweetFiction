<?php
    // requires to set $story and $user to work
    // ie. array('story' => $story['Story'])
?>
<div>
    <div>
        <?php 
            $title = '<span class="story_title">'.$this->Html->link($story['title'], array('controller' => 'stories', 'action' => 'view', $story['id'])).'</span>';
            $author = '<span class="story_author">'.$this->Html->link($user['name'], array('controller' => 'users', 'action' => 'view', $user['id'])).'</span>';
            echo __('%s by %s', $title, $author);
        ?>
        <span class="small_font">(<?php echo h($story['updated']); ?>)</span>
        <?php if ($story['completed']): ?>
            <span class="completed"><?php echo __('Completed'); ?></span>
        <?php endif; ?>
    </div>
    <span class="story_summary"><?php echo ($story['summary']); ?></span>
</div>