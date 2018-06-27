<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityLog $activityLog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Activity Logs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="activityLogs form large-9 medium-8 columns content">
    <?= $this->Form->create($activityLog) ?>
    <fieldset>
        <legend><?= __('Add Activity Log') ?></legend>
        <?php
            echo $this->Form->control('DateAndTime');
            echo $this->Form->control('idUser');
            echo $this->Form->control('userAction');
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
