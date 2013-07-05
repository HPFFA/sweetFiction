<div class="import index">
    <h2><?php echo __('Import'); ?></h2>
<?php echo $this->Form->create('Import'); ?>
    <fieldset>
        <legend><?php echo __('Import from eFiction (HPFFA edition)'); ?></legend>
    <?php
        echo $this->Form->input("path_to_installation");
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>