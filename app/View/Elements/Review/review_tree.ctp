<?php
    // required:
    //  reviews
    //  reference_id
    //  reference_type
    // optional:
    //  parent_id
    if (!isset($parent_id))
    {
        $parent_id = 0;
    }
?>
<div class="reviews">
    <?php 
        echo $this->element("Review/review_form", array(
                'show' => true, 
                'parent_id' => $parent_id,
                'reference_type' => $reference_type,
                'reference_id' => $reference_id));
        foreach ($reviews as $review):
            if ($review['Review']['parent_id'] != $parent_id) continue;
                
            $review_id = $review['Review']['id']; ?>
        <div class="review" id="review_<?php echo $review_id; ?>">
            <a style="float: right" href="#" class="button review_reply"><?php echo __('Reply'); ?></a>
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
            <?php echo $this->element("Review/review_form", array(
                    'reference_id' => $reference_id, 
                    'reference_type' => $reference_type,
                    'parent_id' => $parent_id)); ?>
            <?php 
                $childReviews = array();
                foreach ($reviews as $potentialChildReview)
                {
                    if ($potentialChildReview['Review']['parent_id'] == $review_id)
                    {
                        $childReviews[] = $potentialChildReview;
                    }
                }
                if (!empty($childReviews))
                {
                    echo $this->element("Review/review_tree", array(
                        'reviews' => $childReviews, 
                        'parent_id' => $review_id,
                        'reference_id' => $reference_id,
                        'reference_type' => $reference_type));
                }
            ?>
        </div>
    <?php endforeach; ?>
</div>