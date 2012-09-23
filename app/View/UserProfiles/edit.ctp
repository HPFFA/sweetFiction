<div class="userProfiles form">
<?php echo $this->Form->create('UserProfile'); ?>
	<fieldset>
		<legend><?php echo __('Edit User Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('real_name');
		echo $this->Form->input('brithday');
		echo $this->Form->input('biography');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UserProfile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UserProfile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List User Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
