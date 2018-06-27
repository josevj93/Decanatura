<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityLog[]|\Cake\Collection\CollectionInterface $activityLogs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Activity Log'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activityLogs index large-9 medium-8 columns content">
    <h3><?= __('Activity Logs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('idLog') ?></th>
                <th scope="col"><?= $this->Paginator->sort('DateAndTime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('idUser') ?></th>
                <th scope="col"><?= $this->Paginator->sort('userAction') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activityLogs as $activityLog): ?>
            <tr>
                <td><?= $this->Number->format($activityLog->idLog) ?></td>
                <td><?= h($activityLog->DateAndTime) ?></td>
                <td><?= h($activityLog->idUser) ?></td>
                <td><?= h($activityLog->userAction) ?></td>
                <td><?= h($activityLog->message) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $activityLog->idLog]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $activityLog->idLog]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $activityLog->idLog], ['confirm' => __('Are you sure you want to delete # {0}?', $activityLog->idLog)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
