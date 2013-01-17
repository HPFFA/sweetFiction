<?php 
    // required:
    //  reference_id
    //  reference_type
    // optional:
    //  show
    //  parent_id
    if (!isset($show)) 
    {
        $show = false;
    }
    if (!isset($parent_id))
    {
        $parent_id = 0;
    }
    if ($parent_id == 0):
        echo $this->Html->script('jquery-1.8.3.js'); 
        ?>
        <script>
            $(".review_reply").click(function () {
              $(this).siblings(".review_form").slideToggle("fast");
              
            });
        </script>
<?php endif; ?>
<div class="<?php if (!$show) echo 'hidden'; ?> review_form" id="review_<?php echo $parent_id ?>_reply">
        <?php 
            echo $this->Form->create('Review',
                 array('url' => array( 
                    'controller' => 'reviews', 
                    'action' => 'add', 
                    $parent_id,
                    $reference_type, 
                    $reference_id,  
                ))); 

                if ($this->Auth->user('id') == 0)
                {
                    echo $this->Form->input('user_name');
                }
                echo $this->Form->input('text', array());
            ?>
        <?php echo $this->Form->end(__('Submit')); ?>
</div>