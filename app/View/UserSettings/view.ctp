<div class="userSettings view">
<h2><?php  echo __('User Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userSetting['UserSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userSetting['User']['name'], array('controller' => 'users', 'action' => 'view', $userSetting['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notify For Favorites'); ?></dt>
		<dd>
			<?php echo h($userSetting['UserSetting']['notify_for_favorites']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Notify For Reviews'); ?></dt>
		<dd>
			<?php echo h($userSetting['UserSetting']['notify_for_reviews']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Setting'), array('action' => 'edit', $userSetting['UserSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Setting'), array('action' => 'delete', $userSetting['UserSetting']['id']), null, __('Are you sure you want to delete # %s?', $userSetting['UserSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Setting'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
