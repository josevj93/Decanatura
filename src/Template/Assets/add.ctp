<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      
        <li><?= $this->Html->link(__('Lista Activos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Lista Tipos'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Nuevo Tipo'), ['controller' => 'Types', 'action' => 'add']) ?></li>
       
    </ul>
</nav>
<div class="assets form large-9 medium-8 columns content">
    <?= $this->Form->create($asset) ?>
    <fieldset>
        <legend><?= __('Agregar Activo') ?></legend>
        <?php


            echo $this->Form->input('plaque',array('type' => 'text','label'=>'Placa'));    
            echo $this->Form->control('type_id', array('options' => $types,'label'=>'Tipo'));
            echo $this->Form->control('brand', array('label'=>'Marca'));
            echo $this->Form->control('model' , array('label'=>'Modelo'));
            echo $this->Form->control('series', array('label'=>'Serie'));
            echo $this->Form->control('description', array('label'=>'Descripcion'));
            echo $this->Form->control('state', array('label'=>'Estado'));
            echo $this->Form->control('owner_id', array('label'=>'Dueño'));
            echo $this->Form->control('responsable_id', array('options' => $users, 'empty' => true,'label'=>'Responsable'));
            echo $this->Form->control('location_id',  array('options' => $locations,'label'=>'Ubicacion'));
            echo $this->Form->control('sub_location', array('label'=>'Sub-ubicacion'));
            echo $this->Form->control('year',  array('label'=>'Año'));
            echo $this->Form->control('lendable',  array('label'=>'Prestable'));
            echo $this->Form->control('observations', array('label'=>'Observaciones'));
        ?>
    </fieldset>
    <a href="javascript:window.history.back()">Cancelar</a>
    <?= $this->Form->button(__('Agregar')) ?>
    <?= $this->Form->end() ?>
</div>