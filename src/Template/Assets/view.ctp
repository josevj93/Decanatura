<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset'), ['action' => 'edit', $asset->plaque]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset'), ['action' => 'delete', $asset->plaque], ['confirm' => __('Are you sure you want to delete # {0}?', $asset->plaque)]) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assets view large-9 medium-8 columns content">
    <h3><?= h($asset->plaque) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Plaque') ?></th>
            <td><?= h($asset->plaque) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand') ?></th>
            <td><?= h($asset->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Model') ?></th>
            <td><?= h($asset->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Series') ?></th>
            <td><?= h($asset->series) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($asset->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($asset->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $asset->has('user') ? $this->Html->link($asset->user->id, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Location') ?></th>
            <td><?= h($asset->sub_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Owner Id') ?></th>
            <td><?= $this->Number->format($asset->owner_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $this->Number->format($asset->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lot') ?></th>
            <td><?= $this->Number->format($asset->lot) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lendable') ?></th>
            <td><?= $asset->lendable ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observations') ?></h4>
        <?= $this->Text->autoParagraph(h($asset->observations)); ?>
    </div>
</div>
