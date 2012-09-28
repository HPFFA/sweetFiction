<div class="groups view">
<h2><?php  echo __('Group'); ?></h2>
    <dl>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($group['Group']['name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Members'); ?></dt>
        <dd>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?><br />
                <?php endforeach; ?>
            <?php else: ?>
                <?php echo __('No members'); ?>
            <?php endif; ?>
        </dd>
    </dl>
</div>
