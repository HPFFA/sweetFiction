<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
            echo $this->Form->input('confirmation', array('type' => 'password'));

            $selected = array();
            if (array_key_exists('GroupAssociations', $this->request->data)){
                foreach ($this->request->data['GroupAssociations'] as $association){
                    $selected[] = $association['id'];
                }
            }
            echo $this->Form->input('groupAssociation', array('options' => $groups, 'selected' => $selected, 'type' => 'select', 'multiple' => 'checkbox'));
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Profile'); ?></legend>
        <?php
            echo $this->Form->input('UserProfile.real_name');
            echo $this->Form->input('UserProfile.birthday');
            echo $this->Form->input('UserProfile.biography');
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Contact'); ?></legend>
        <?php
            echo $this->Form->input('UserContact.homepage');
            echo $this->Form->input('UserContact.public_email');
            echo $this->Form->input('UserContact.icq');
            echo $this->Form->input('UserContact.yahoo');
            echo $this->Form->input('UserContact.msn');
            echo $this->Form->input('UserContact.skype');
            echo $this->Form->input('UserContact.aol');
        ?>
    </fieldset>
    <fieldset>
        <legend><?php echo __('Settings'); ?></legend>
        <?php
            echo $this->Form->input('UserSetting.notify_for_favorites', array('type' => 'checkbox'));
            echo $this->Form->input('UserContact.notify_for_reviews', array('type' => 'checkbox'));
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
    </ul>
</div>
