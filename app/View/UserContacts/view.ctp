<div class="userContacts view">
<h2><?php  echo __('User Contact'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($userContact['User']['name'], array('controller' => 'users', 'action' => 'view', $userContact['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Homepage'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['homepage']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Public Email'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['public_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icq'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['icq']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yahoo'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['yahoo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Msn'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['msn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skype'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['skype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Aol'); ?></dt>
		<dd>
			<?php echo h($userContact['UserContact']['aol']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Contact'), array('action' => 'edit', $userContact['UserContact']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Contact'), array('action' => 'delete', $userContact['UserContact']['id']), null, __('Are you sure you want to delete # %s?', $userContact['UserContact']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Contacts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Contact'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
