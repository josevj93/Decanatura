<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loan $loan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Loan'), ['action' => 'edit', $loan->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Loan'), ['action' => 'delete', $loan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loan->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Loans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Loan'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="loans view large-9 medium-8 columns content">
    <h3><?= h($loan->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($loan->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Assets') ?></th>
            <td><?= h($loan->id_assets) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($loan->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Responsables') ?></th>
            <td><?= $this->Number->format($loan->id_responsables) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Inicio') ?></th>
            <td><?= h($loan->fecha_inicio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Devolucion') ?></th>
            <td><?= h($loan->fecha_devolucion) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($loan->observaciones)); ?>
    </div>
</div>
