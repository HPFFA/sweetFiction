<?php 
    // required:
    //  reference_id
    //  reference_type
    // optional:
    //  show
    //  parent
    if ($first_time):
        echo $this->Html->script('jquery-1.8.3.js'); 
    ?>
    <script>
        var review_reply_initialized = false;
        $(window).load(function(){
            if (!review_reply_initialized)
            {
                review_reply_initialized = true;
                $(".review_reply").click(function () {
                    if ($(this).parent().siblings(" form").is(":visible"))
                    {
                        $(this).text('<?php echo __("Review"); ?>');
                    }
                    else
                    {
                        $(this).text('<?php echo __("Hide"); ?>');
                    }
                    $(this).parent().siblings("form").slideToggle("fast");
                });
            }
        });
    </script>
<?php endif; ?>
<div class="review_form" id="review_<?php echo $parent != null ? $parent['Review']['id'] : 0  ?>_reply" >
    <div class="beam_button">
        <a  href="#" class="button review_reply"><?php echo (!$show ?  __("Review") : __("Hide")); ?></a>
    </div>
    <?php 
        echo $this->Form->create('Review',
             array('url' => array( 
                'controller' => 'reviews', 
                'action' => 'add', 
                $parent == null ? 0 : $parent['Review']['id'],
                $reference_type, 
                $reference_id,  
            ), 'style' => $show ? "display: block" : "display: none")); 

            if ($this->Auth->user('id') == 0)
            {
                echo $this->Form->input('user_name');
            }
            echo $this->Form->input('text', array());
        ?>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>