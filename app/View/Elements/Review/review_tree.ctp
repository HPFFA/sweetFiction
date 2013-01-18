<?php
    // required:
    //  reviews
    //  reference_id
    //  reference_type
    // optional:
    //  parent
    //  is_author
    if (!isset($is_author))
    {
        $is_author = false;
    }
    if (!isset($show)) 
    {
        $show = false;
    }
    if (!isset($parent))
    {
        $parent = null;
    }
?>
<div class="reviews">
    <?php

        $showForm = !$is_author;
        //debug($showForm);
        $showForm &= !isset($review) || ($review['Review']['user_id'] != $this->Auth->user('id'));
        //debug($showForm);
        $showForm &= $parent == null || ($parent['Review']['user_id'] != $this->Auth->user('id'));
        //debug($showForm);
        if ($showForm)
        {
            echo $this->element("Review/review_form", array(
                    'show' => $show, 
                    'parent' => $parent,
                    'reference_type' => $reference_type,
                    'reference_id' => $reference_id));
        }
        
        
        $parent_id = $parent == null ? 0 : $parent['Review']['id'];

        foreach ($reviews as $review):
            if ($review['Review']['parent_id'] != $parent_id)
            {
                continue;  
            }

            $review_id = $review['Review']['id']; 
    ?>
        <div class="review" id="review_<?php echo $review_id; ?>">
            <div  class="text">
                <?php echo h($review['Review']['text']); ?>
            </div>
            <div class="metadata author">
                <?php 
                    $author = h($review['Review']['user_name']);
                    if ($review['Review']['user_id'] != 0)
                    {
                        $author = $this->Html->link($review['User']['name'], array('controller' => 'users', 'action' => 'view', $review['User']['id'])); 
                    }
                    echo __("by %s", $author);
                ?>
                <span class="metadata date">(<?php echo h($review['Review']['created']); ?>)</span>
            </div>
            <?php 
                $childReviews = array();
                foreach ($reviews as $potentialChildReview)
                {
                    if ($potentialChildReview['Review']['parent_id'] == $review_id)
                    {
                        $childReviews[] = $potentialChildReview;
                    }
                }
                echo $this->element("Review/review_tree", array(
                    'reviews' => $childReviews, 
                    'parent' => $review,
                    'reference_id' => $reference_id,
                    'reference_type' => $reference_type));
             ?>
        </div>
    <?php endforeach; ?>
</div>