<div id="navigation">
    <?php echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'display', 'home')); ?>
    <?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?>
    <?php echo $this->Html->link(__('Stories'), array('controller' => 'stories', 'action' => 'index')); ?>
</div>