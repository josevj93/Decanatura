<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types form large-9 medium-8 columns content">
    <?= $this->Form->create($type) ?>
    <fieldset>
        <legend><?= __('Agregar tipo') ?></legend>
        <?php
            echo $this->Form->input('type_id', array('type' => 'text', 'label' => 'ID'));
            echo $this->Form->input('name', array('label' => 'Nombre'));
            echo $this->Form->input('description', array('label' => 'Descripción'));
        ?>
    </fieldset>
    <a href="javascript:window.history.back()">Cancelar</a>
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>


</div>
