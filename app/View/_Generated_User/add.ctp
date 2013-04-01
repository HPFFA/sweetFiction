<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('state');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List User Settings'), array('controller' => 'user_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Setting'), array('controller' => 'user_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Contacts'), array('controller' => 'user_contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Contact'), array('controller' => 'user_contacts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Profiles'), array('controller' => 'user_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Profile'), array('controller' => 'user_profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Group Associations'), array('controller' => 'user_group_associations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group Associations'), array('controller' => 'user_group_associations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stories'), array('controller' => 'stories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Story Chapters'), array('controller' => 'story_chapters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Chapter'), array('controller' => 'story_chapters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('controller' => 'reviews', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Story Review'), array('controller' => 'reviews', 'action' => 'add')); ?> </li>
	</ul>
</div>
