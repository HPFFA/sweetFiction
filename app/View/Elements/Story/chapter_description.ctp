<?php
    // requires to set $story, $chapter and $user to work
    // ie. array('story' => $story['Story'])
?>
<div>
    <?php 
        $title = '<span class="chapter_title">'.$this->Html->link($chapter['title'], array('controller' => 'story_chapters', 'action' => 'view', $story['id'], $chapter['id'])).'</span>';
        if ($chapter['user_id'] != $story['user_id'])
        {
            $author = '<span class="chapter_author">'.$this->Html->link($user['name'], array('controller' => 'users', 'action' => 'view', $user['id'])).'</span>';
            echo __('%s by %s', $title, $author);    
        }
        else
        {
            echo $title;
        }            
    ?>
    <span class="small_font">(<?php echo h($story['updated']); ?>)</span>
    <?php if ($story['completed']): ?>
        <span class="completed"><?php echo __('Completed'); ?></span>
    <?php endif; ?>
</div>
<span class="story_summary"><?php echo ($story['summary']); ?></span>
