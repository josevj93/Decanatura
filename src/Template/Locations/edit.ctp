<div class="locations edit large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Modificar Ubicacion') ?></legend>
        
            <?php 
            echo $this->Form->control('nombre', array('label' => 'Nombre:'));
            echo $this->Form->textarea('description', array('label' => 'Descripcion:'));
             ?>
        
    </fieldset>

    <style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left: 10px;
    }
</style> 

    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</div>
