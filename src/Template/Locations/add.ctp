<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Insertar Ubicacion') ?></legend>
        <?php
            echo $this->Form->input('location_id', array('type' => 'text', 'label' => 'Id'));
            echo $this->Form->control('description', array('label' => 'Descripcion'));
            echo $this->Form->control('nombre', array('label' => 'Nombre'));
        ?>
    </fieldset>
    <style>
        .btn-primary {
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
    </style>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</div>
