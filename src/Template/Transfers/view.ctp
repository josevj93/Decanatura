<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Transfer'), ['action' => 'edit', $transfer->transfers_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Transfer'), ['action' => 'delete', $transfer->transfers_id], ['confirm' => __('Are you sure you want to delete # {0}?', $transfer->transfers_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Transfers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Transfer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="transfers view large-9 medium-8 columns content">
    <h3><?= h($transfer->transfers_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Transfers Id') ?></th>
            <td><?= h($transfer->transfers_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Acade Unit Recib') ?></th>
            <td><?= h($transfer->Acade_Unit_recib) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Functionary') ?></th>
            <td><?= h($transfer->functionary) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identification') ?></th>
            <td><?= h($transfer->identification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Functionary Recib') ?></th>
            <td><?= h($transfer->functionary_recib) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identification Recib') ?></th>
            <td><?= h($transfer->identification_recib) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($transfer->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Assets') ?></h4>
        <?php if (!empty($transfer->assets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Plaque') ?></th>
                <th scope="col"><?= __('Type Id') ?></th>
                <th scope="col"><?= __('Brand') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Series') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('State') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Owner Id') ?></th>
                <th scope="col"><?= __('Responsable Id') ?></th>
                <th scope="col"><?= __('Location Id') ?></th>
                <th scope="col"><?= __('Sub Location') ?></th>
                <th scope="col"><?= __('Year') ?></th>
                <th scope="col"><?= __('Lendable') ?></th>
                <th scope="col"><?= __('Observations') ?></th>
                <th scope="col"><?= __('Image Dir') ?></th>
                <th scope="col"><?= __('Unique Id') ?></th>
                <th scope="col"><?= __('Deletable') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Residues Id') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($transfer->assets as $assets): ?>
            <tr>
                <td><?= h($assets->plaque) ?></td>
                <td><?= h($assets->type_id) ?></td>
                <td><?= h($assets->brand) ?></td>
                <td><?= h($assets->model) ?></td>
                <td><?= h($assets->series) ?></td>
                <td><?= h($assets->description) ?></td>
                <td><?= h($assets->state) ?></td>
                <td><?= h($assets->image) ?></td>
                <td><?= h($assets->owner_id) ?></td>
                <td><?= h($assets->responsable_id) ?></td>
                <td><?= h($assets->location_id) ?></td>
                <td><?= h($assets->sub_location) ?></td>
                <td><?= h($assets->year) ?></td>
                <td><?= h($assets->lendable) ?></td>
                <td><?= h($assets->observations) ?></td>
                <td><?= h($assets->image_dir) ?></td>
                <td><?= h($assets->unique_id) ?></td>
                <td><?= h($assets->deletable) ?></td>
                <td><?= h($assets->created) ?></td>
                <td><?= h($assets->modified) ?></td>
                <td><?= h($assets->residues_id) ?></td>
                <td><?= h($assets->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Assets', 'action' => 'view', $assets->plaque]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Assets', 'action' => 'edit', $assets->plaque]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assets', 'action' => 'delete', $assets->plaque], ['confirm' => __('Are you sure you want to delete # {0}?', $assets->plaque)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
