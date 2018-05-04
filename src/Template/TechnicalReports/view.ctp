<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Technical Report'), ['action' => 'edit', $technicalReport->technical_report_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Technical Report'), ['action' => 'delete', $technicalReport->technical_report_id], ['confirm' => __('Are you sure you want to delete # {0}?', $technicalReport->technical_report_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Technical Reports'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Technical Report'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="technicalReports view large-9 medium-8 columns content">
    <h3><?= h($technicalReport->technical_report_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Asset') ?></th>
            <td><?= $technicalReport->has('asset') ? $this->Html->link($technicalReport->asset->plaque, ['controller' => 'Assets', 'action' => 'view', $technicalReport->asset->plaque]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Evaluation') ?></th>
            <td><?= h($technicalReport->evaluation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Recommendation') ?></th>
            <td><?= h($technicalReport->recommendation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Technical Report Id') ?></th>
            <td><?= $this->Number->format($technicalReport->technical_report_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($technicalReport->date) ?></td>
        </tr>
    </table>
</div>
