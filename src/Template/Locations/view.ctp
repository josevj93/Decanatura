<div class="locations view large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Consultar Ubicación') ?></legend><br>
            <div>
                <label>Id:</label><br>
                <?php 
                echo $this->Form->imput('location_id',  ['label' => 'Id:', 'class'=>'form-control col-sm-2', 'disabled']);
                ?><br>
            </div>
            <div>
                <label>Nombre:</label><br>
                <?php 
                echo $this->Form->imput('nombre', ['label' => 'Nombre:', 'class'=>'form-control col-sm-2', 'disabled']);
                ?><br>
            </div>
            <div>
                <label>Descripción:</label><br>
                <?php 
                echo $this->Form->textarea('description', ['label' => 'Descripción:', 'class'=>'form-control col-sm-4', 'disabled']);
                ?><br>
            </div>
    </fieldset>

<style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left:10px;
    }
</style> 
    
    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $location->location_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar la Ubicación # {0}?', $location->location_id)]) ?>
    <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $location->location_id], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

</div>
