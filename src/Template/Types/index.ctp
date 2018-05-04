<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type[]|\Cake\Collection\CollectionInterface $types
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">

       <li><?= $this->Html->link(__('Activos'), ['controller' => 'Assets','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Tipos'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        
       
    </ul>
</nav>

<div class="types index large-9 medium-8 columns content">
    <h3><?= __('Tipos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('type_id', 'Tipo' ) ?></th>
                <th scope="col"><?= $this->Paginator->sort('name','Nombre') ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($types as $type): ?>
            <tr>
                <td><?= h($type->type_id) ?></td>
                <td><?= h($type->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Consultar'), ['action' => 'view', $type->type_id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $type->type_id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $type->type_id], ['confirm' => __('Seguro que desea eliminar el activo # {0}?', $type->type_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">

       <?= $this->Html->link(__('Agregar tipo'), ['action' => 'add']) ?> 
    </dright<>