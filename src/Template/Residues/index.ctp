<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue[]|\Cake\Collection\CollectionInterface $residues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Residue'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="residues index large-9 medium-8 columns content">
    <h3><?= __('Residues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('residues_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identification1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('identification2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($residues as $residue): ?>
            <tr>
                <td><?= h($residue->residues_id) ?></td>
                <td><?= h($residue->name1) ?></td>
                <td><?= h($residue->identification1) ?></td>
                <td><?= h($residue->name2) ?></td>
                <td><?= h($residue->identification2) ?></td>
                <td><?= h($residue->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $residue->residues_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $residue->residues_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $residue->residues_id], ['confirm' => __('Are you sure you want to delete # {0}?', $residue->residues_id)]) ?>
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
