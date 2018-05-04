<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset[]|\Cake\Collection\CollectionInterface $assets
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">

       <li><?= $this->Html->link(__('Activos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tipos'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        
       
    </ul>
</nav>
<div class="assets index large-9 medium-8 columns content">
    <h3><?= __('Activos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('plaque','Placa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type_id','Tipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand','Marca') ?></th>
            
                <th scope="col"><?= $this->Paginator->sort('description','Descripcion') ?></th>
              
               
                <th scope="col"><?= $this->Paginator->sort('responsable_id','Responsable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id','Ubicacion') ?></th>
               
                <th scope="col"><?= $this->Paginator->sort('year','Año') ?></th>
                
            
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assets as $asset): ?>
            <tr>    
                <td><?= h($asset->plaque) ?></td>
                <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
                <td><?= h($asset->brand) ?></td>
              
               
                <td><?= h($asset->description) ?></td>
              
                <td><?= $this->Number->format($asset->owner_id) ?></td>
                
                <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
               
                <td><?= $this->Number->format($asset->year) ?></td>
              
                <td class="actions">
                    <?= $this->Html->link(__('Consultar'), ['action' => 'view', $asset->plaque]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $asset->plaque]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $asset->plaque], ['confirm' => __('Esta seguro que desea eliminar el activo # {0}?', $asset->plaque)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <?= $this->Html->link(__('Agregar activo'), ['action' => 'add']) ?> 
   
    </div>
</div>
