<div class="userContacts form">
<?php echo $this->Form->create('UserContact'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Contact'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('homepage');
		echo $this->Form->input('public_email');
		echo $this->Form->input('icq');
		echo $this->Form->input('yahoo');
		echo $this->Form->input('msn');
		echo $this->Form->input('skype');
		echo $this->Form->input('aol');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserContact.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserContact.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Contacts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
