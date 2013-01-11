<div class="users index">
    <h2><?php echo __('Users'); ?></h2>
        <div class="sorting">
        <h4><?php echo __('Sorting'); ?></h4>
        <span><?php echo $this->Paginator->sort('name'); ?></span>
    </div>

    <table cellpadding="0" cellspacing="0">
        <?php foreach ($users as $user): ?>
            <tr id="list_user_<?php echo $user['User']['id']; ?>">
                <td>
                    <?php echo $this->Html->link(h($user['User']['name']), array('action' => 'view', $user['User']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php 
            echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
        ?>  
    </p>

    <div class="paging">
        <?php
            echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>