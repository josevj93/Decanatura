<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loan[]|\Cake\Collection\CollectionInterface $loans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Loan'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="loans index large-9 medium-8 columns content">
    <h3><?= __('Loans') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_assets') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_responsables') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_inicio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_devolucion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loans as $loan): ?>
            <tr>
                <td><?= h($loan->id) ?></td>
                <td><?= h($loan->id_assets) ?></td>
                <td><?= $this->Number->format($loan->id_responsables) ?></td>
                <td><?= h($loan->fecha_inicio) ?></td>
                <td><?= h($loan->fecha_devolucion) ?></td>
                <td><?= h($loan->estado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $loan->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $loan->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $loan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $loan->id)]) ?>
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
