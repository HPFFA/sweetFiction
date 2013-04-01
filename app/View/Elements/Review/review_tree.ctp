<?php
    // required:
    //  reviews
    //  reference_id
    //  reference_type
    // optional:
    //  parent
    //  is_author
    //  root_reviews
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
    if (!isset($review))
    {
        $review = null;
    }
    if (!isset($root_reviews))
    {
        $root_reviews = $reviews;
    }
    if (!isset($first_time))
    {
        $first_time = true;
    }
?>
<div class="reviews">
    <?php
        if ($this->Review->shouldRenderForm($is_author, $review, $parent))
        {
            $this->Review->setErrorsForForm($review);
            echo $this->element("Review/review_reply_form", array(
                    'first_time' => $first_time,
                    'parent' => $parent,
                    'reference_id' => $reference_id));
            $this->Review->unsetErrorsForForm();
            $first_time = false;
        }
        
        
        $parent_id = $parent == null ? 0 : $parent['Review']['id'];

        foreach ($reviews as $review):
            if ($review['Review']['parent_id'] != $parent_id)
            {
                continue;  
            }

            $review_id = $review['Review']['id']; ?>
            <script>
                var review_edit_initialized = false;
                $(window).load(function(){
                    if (!review_edit_initialized)
                    {
                        review_edit_initialized = true;
                        $(".review_edit").click(function () {
                            if ($(this).parent().siblings(" form").is(":visible"))
                            {
                                $(this).text('<?php echo __("Edit"); ?>');
                            }
                            else
                            {
                                $(this).text('<?php echo __("Cancel"); ?>');
                            }
                            $(this).parent().siblings("form").slideToggle("fast");
                            $(this).parent().parent().siblings("div").slideToggle("fast");
                        });
                    }
                });
            </script>
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
                    <span class="metadata date">(<?php echo h($review['Review']['created']); ?>)
                        <?php if ($review['Review']['user_id'] != 0 && $this->Auth->user('id') == $review['Review']['user_id']): ?>
                            <a href="#" class="button review_edit"><?php echo __("Edit") ?></a>
                        <?php endif; ?>
                    </span>
                    <?php if ($review['Review']['user_id'] != 0 && $this->Auth->user('id') == $review['Review']['user_id'])
                    {
                        echo $this->element("Review/review_form", array(
                                'reference_id' => $reference_id,
                                'parent' => $parent,
                                'review' => $review
                        ));
                    }
                    ?>
                </div>
                <?php 
                    echo $this->element("Review/review_tree", array(
                        'first_time' => $first_time,
                        'reviews' => $this->Review->childReviews($root_reviews, $review), 
                        'root_reviews' => $root_reviews,
                        'parent' => $review,
                        'reference_id' => $reference_id,
                        'reference_type' => $reference_type));
                 ?>
            </div>
    <?php endforeach; ?>
</div>