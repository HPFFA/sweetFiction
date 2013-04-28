<ul>
    <?php 
        $stories = $this->requestAction('stories/index/sort:updated/direction:desc/limit:5');
        foreach ($stories as $story) : ?>
            <li>
                <?php 
                    $storyLink = $this->html->link($story['Story']['title'], array('controller' => 'stories', 'action' => 'view', $story['Story']['id']));
                    $authorLink = $this->html->link($story['User']['name'], array('controller' => 'users', 'action' => 'view', $story['User']['id']));
                    echo __('%s by %s', $storyLink, $authorLink) 
                ?>
            </li>
    <?php endforeach; ?>
</ul>