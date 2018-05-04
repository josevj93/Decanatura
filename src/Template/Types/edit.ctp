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
            echo $this->Form->control('name', array('label'=>'Nombre'));
            echo $this->Form->control('description',  array('label'=>'Descripción'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar')) ?>
      <a href="javascript:window.history.back()">Cancelar</a>
    <?= $this->Form->end() ?>
</div>
