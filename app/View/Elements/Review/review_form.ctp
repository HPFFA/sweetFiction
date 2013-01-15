<?php 
    if (!isset($show)) 
    {
        $show = false;
    }
    if ($parent_id == 0):
        echo $this->Html->script('jquery-1.8.3.js'); 
        ?>
        <script>
                // $(document).ready(function(){
                // $('a.review_reply').bind("click", function(event)
                // {
                //         var str = event.target.id;
                //         alert (str);
                //         var uid = str.substring(str.indexOf("_") + 1);
                //         //connect (uid);
                // });
        //});
                $(".review_reply").click(function () {
                  $(this).siblings(".review_reply_form").slideToggle("fast");
                  
                });
        </script>
<?php endif; ?>
<div class="<?php if (!$show) echo 'hidden'; ?> review_reply_form">
    <form  id="review_<?php echo $parent_id ?>_reply">
        <?php echo $this->Form->create('Review'); ?>
            <?php if (isset($parent_id)): ?>
                <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>" />
            <?php endif; 
                if ($this->Auth->user('id') == 0)
                {
                    echo $this->Form->input('user_name');
                }
                echo $this->Form->input('text', array());
            ?>
        <?php echo $this->Form->end(__('Submit')); ?>
    </form>
</div>