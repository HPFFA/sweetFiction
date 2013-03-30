<?php 
    // required:
    //  reference_id
    // optional:
    //  parent
    //  review - implicit
    if ($first_time):
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
        <a  href="#" class="button review_reply"><?php echo (!$this->Review->showForm($parent) ?  __("Review") : __("Hide")); ?></a>
    </div>
    <?php 
        $this->Review->setErrorsForForm($parent);
        echo $this->element("Review/review_form", array(
                'reference_id' => $reference_id,
                'parent' => $parent
        ));
        $this->Review->unsetErrorsForForm();
    ?>
</div>