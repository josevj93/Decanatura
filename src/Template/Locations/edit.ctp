<div class="locations edit large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Modificar Ubicacion') ?></legend><br>
            <div>
                <label>Id:</label><br>
                <?php 
                echo $this->Form->imput('location_id', ['label' => 'Id:', 'class'=>'form-control col-sm-2', 'disabled']);
                ?><br>
            </div>
            <div>
                <?php 
                echo $this->Form->control('nombre', ['label' => 'Nombre:', 'class'=>'form-control col-sm-2']);
                ?><br>
            </div>
            <div>
                <label>Descripción:</label><br>
                <?php 
                echo $this->Form->textarea('description', ['label' => 'Descripción:', 'class'=>'form-control col-sm-4']);
                ?><br>
            </div>
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

    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
</div>
