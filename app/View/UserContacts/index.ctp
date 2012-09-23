<div class="userContacts index">
	<h2><?php echo __('User Contacts'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('homepage'); ?></th>
			<th><?php echo $this->Paginator->sort('public_email'); ?></th>
			<th><?php echo $this->Paginator->sort('icq'); ?></th>
			<th><?php echo $this->Paginator->sort('yahoo'); ?></th>
			<th><?php echo $this->Paginator->sort('msn'); ?></th>
			<th><?php echo $this->Paginator->sort('skype'); ?></th>
			<th><?php echo $this->Paginator->sort('aol'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($userContacts as $userContact): ?>
	<tr>
		<td><?php echo h($userContact['UserContact']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userContact['User']['name'], array('controller' => 'users', 'action' => 'view', $userContact['User']['id'])); ?>
		</td>
		<td><?php echo h($userContact['UserContact']['homepage']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['public_email']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['icq']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['yahoo']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['msn']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['skype']); ?>&nbsp;</td>
		<td><?php echo h($userContact['UserContact']['aol']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $userContact['UserContact']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userContact['UserContact']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $userContact['UserContact']['id']), null, __('Are you sure you want to delete # %s?', $userContact['UserContact']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User Contact'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
