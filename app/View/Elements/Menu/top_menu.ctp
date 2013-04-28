<div id="welcome_message">
    <?php $username = __('Guest');
        if ($this->Auth->currentUser())
        {
            $username = $this->Auth->currentUser('name');
        }
        echo __('Welcome %s', $username); 
    ?>
</div>
<div id="user_menu">
    <?php if ($this->Auth->currentUser() == null): ?>
        <?php echo $this->Html->link(__('Login'), array('controller' => 'authentication', 'action' => 'login')); ?>
        <?php echo $this->Html->link(__('Register'), array('controller' => 'authentication', 'action' => 'register')); ?>
    <?php else: ?>
        <?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'view', $this->Auth->currentUser('id'))); ?>
        <?php echo $this->Html->link(__('Logout'), array('controller' => 'authentication', 'action' => 'logout')); ?>
    <?php endif; ?>
</div>