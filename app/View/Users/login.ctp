<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your credentials'); ?></legend>
    <?php
        echo $this->Form->input('name');
        echo $this->Form->input('password');
        echo $this->Form->input('Session.keep_logged_in', array('type' => 'checkbox'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login'));?>
</div>
