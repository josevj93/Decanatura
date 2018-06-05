<div class="locations form large-9 medium-8 columns content">
    <?= $this->Form->create($location) ?>
    <fieldset>
        <legend><?= __('Insertar Ubicacion') ?></legend>
            <div>
                <label>Id:</label><br>
                <?php 
                echo $this->Form->imput('location_id', ['label' => 'Id:', 'class'=>'form-control col-sm-2']);
                ?><br>
            </div>
            <div>
                <label>Nombre:</label><br>
                <?php 
                echo $this->Form->imput('nombre', ['label' => 'Nombre:', 'class'=>'form-control col-sm-2']);
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
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
    </style>
    
</div>

 <?= $this->Html->link(__('Cancelar'), ['controller'=> 'Locations', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
 <?= $this->Form->button(__('Aceptar'), ['controller'=> 'Locations', 'class' => 'btn btn-primary']) ?>
