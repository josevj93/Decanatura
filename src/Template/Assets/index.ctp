<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset[]|\Cake\Collection\CollectionInterface $assets
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assets index large-9 medium-8 columns content">
    <h3><?= __('Assets') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('plaque') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('model') ?></th>
                <th scope="col"><?= $this->Paginator->sort('series') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('owner_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('responsable_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('year') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lendable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lot') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assets as $asset): ?>
            <tr>
                <td><?= h($asset->plaque) ?></td>
                <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
                <td><?= h($asset->brand) ?></td>
                <td><?= h($asset->model) ?></td>
                <td><?= h($asset->series) ?></td>
                <td><?= h($asset->description) ?></td>
                <td><?= h($asset->state) ?></td>
                <td><?= $this->Number->format($asset->owner_id) ?></td>
                <td><?= $asset->has('user') ? $this->Html->link($asset->user->id, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?></td>
                <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
                <td><?= h($asset->sub_location) ?></td>
                <td><?= $this->Number->format($asset->year) ?></td>
                <td><?= h($asset->lendable) ?></td>
                <td><?= $this->Number->format($asset->lot) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $asset->plaque]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $asset->plaque]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $asset->plaque], ['confirm' => __('Are you sure you want to delete # {0}?', $asset->plaque)]) ?>
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
