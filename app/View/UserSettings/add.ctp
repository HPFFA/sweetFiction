<div class="userSettings form">
<?php echo $this->Form->create('UserSetting'); ?>
	<fieldset>
		<legend><?php echo __('Add User Setting'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('notify_for_favorites');
		echo $this->Form->input('notify_for_reviews');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List User Settings'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
