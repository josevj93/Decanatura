<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        
        <li><?= $this->Html->link(__('Activos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tipos'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
         <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $asset->plaque]) ?> </li>
        
     
    </ul>
</nav>
<div class="assets view large-9 medium-8 columns content">
    <h3>Consulta</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Placa') ?></th>
            <td><?= h($asset->plaque) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($asset->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= h($asset->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serie') ?></th>
            <td><?= h($asset->series) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripción') ?></th>
            <td><?= h($asset->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($asset->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsable') ?></th>
            <td><?= $asset->has('user') ? $this->Html->link($asset->user->id, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ubicación') ?></th>
            <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub-ubicación') ?></th>
            <td><?= h($asset->sub_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dueño') ?></th>
            <td><?= $this->Number->format($asset->owner_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Año') ?></th>
            <td><?= $this->Number->format($asset->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prestable') ?></th>
            <td><?= $asset->lendable ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Observaciones') ?></h4>
        <?= $this->Text->autoParagraph(h($asset->observations)); ?>
    </div>
</div>