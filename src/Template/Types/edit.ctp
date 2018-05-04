<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types form large-9 medium-8 columns content">
    <?= $this->Form->create($type) ?>
    <fieldset>
        <legend><?= __('Editar') ?></legend>
        <?php
            echo $this->Form->control('name', array('label'=>'Nombre', 'class' => 'form-control'));
            echo $this->Form->control('description',  array('label'=>'Descripción', 'class' => 'form-control'));
        ?>
    </fieldset>
    
    
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Types', 'action' => 'index'], ['class' => 'btn btn-danger']) ?>
     

    
    <?= $this->Form->end() ?>
</div>