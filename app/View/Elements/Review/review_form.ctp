<?php 
    // required:
    //  reference_id
    //  reference_type
    // optional:
    //  show
    //  parent_id
    if (!isset($parent_id))
    {
        $parent_id = 0;
    }
    if ($parent_id == 0):
        echo $this->Html->script('jquery-1.8.3.js'); 
        ?>
        <script>
            var initiliazed = false;
            $(window).load(function(){
                if (!initiliazed)
                {
                    initiliazed = true;
                    $(".review_reply").click(function () {
                        if ($(this).parent().siblings(" form").is(":visible"))
                        {
                            $(this).text('<?php echo ($parent_id == 0 ? __("Add Review") : __("Reply to Review")); ?>');
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

<div class="review_form" id="review_<?php echo $parent_id ?>_reply" >
    <div class="beam_button">
        <a  href="#" class="button review_reply"><?php echo (!$show ? ($parent_id == 0 ? __("Add Review") : __("Reply to Review")) :__("Hide")); ?></a>
    </div>
    <?php 
        echo $this->Form->create('Review',
             array('url' => array( 
                'controller' => 'reviews', 
                'action' => 'add', 
                $parent_id,
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