<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
?>
<style>
    td, th {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
    }
</style>
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

                <th scope="col"><?= __('Brand') ?></th>
                <th scope="col"><?= __('Model') ?></th>
                <th scope="col"><?= __('Series') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($transfer->assets as $assets): ?>
            <tr>
                <td><?= h($assets->plaque) ?></td>

                <td><?= h($assets->brand) ?></td>
                <td><?= h($assets->model) ?></td>
                <td><?= h($assets->series) ?></td>
                <td><?= h($assets->description) ?></td>

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
