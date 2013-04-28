<div class="user view">
    <h2><?php  echo $user['User']['name'];  ?></h2>
    <dl>
        <dt><?php echo __('Roles'); ?></dt>
        <dd>
            <?php foreach ($roles as $role): ?>
                <?php
                    //echo $this->Html->link($role['Role']['name'], array('controller' => 'roles', 'action' => 'view', $role['Role']['id'])); 
                    echo $role['Role']['name'];
                ?></td>
                &nbsp;
            <?php endforeach; ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Real Name'); ?></dt>
        <dd id="user_real_name">
            <?php echo h($user['UserProfile']['real_name']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Birthday'); ?></dt>
        <dd id="user_birthday">
            <?php echo h($user['UserProfile']['birthday']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Biography'); ?></dt>
        <dd  id="user_biography">
            <?php echo ($user['UserProfile']['biography']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Homepage'); ?></dt>
        <dd  id="user_homepage">
            <?php echo h($user['UserContact']['homepage']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Public Email'); ?></dt>
        <dd  id="user_email">
            <?php echo h($user['UserContact']['public_email']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Icq'); ?></dt>
        <dd  id="user_icq">
            <?php echo h($user['UserContact']['icq']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Yahoo'); ?></dt>
        <dd  id="user_yahoo">
            <?php echo h($user['UserContact']['yahoo']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Msn'); ?></dt>
        <dd  id="user_msn">
            <?php echo h($user['UserContact']['msn']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Skype'); ?></dt>
        <dd  id="user_skype">
            <?php echo h($user['UserContact']['skype']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Aol'); ?></dt>
        <dd  id="user_aol">
            <?php echo h($user['UserContact']['aol']); ?>
            &nbsp;
        </dd>
    </dl>
    <?php if (!empty($user['Story'])): ?>
    <h3 ><?php echo __('Stories'); ?></h3>
    <div class="stories">
        <?php foreach ($user['Story'] as $story): ?>
            <div>
                <span class="story_title">
                    <?php echo$this->Html->link($story['title'], array('controller' => 'stories', 'action' => 'view', $story['id'])); ?>
                </span>
                <span class="small_font">(<?php echo h($story['created']); ?>)</span>
                <?php if ($story['completed']): ?>
                    <span class="completed"><?php echo __('Completed'); ?></span>
                <?php endif; ?>
            </div>
            <span class="story_summary"><?php echo ($story['summary']); ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>

<?php if ($this->Auth->user('id') == $user['User']['id']): ?>
    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('New Story'), array('controller' => 'stories', 'action' => 'add')); ?></li>
            <li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', h($user['User']['id']))); ?></li>
        </ul>
    </div>
<?php endif; ?>