<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Modificar acta de desecho') ?></legend>
            <div class='row'>
                <label>Número de Autorización:  </label>
                VRA-
                <?php 
                    echo $this->Form->imput('residues_id', ['class'=>'form-control col-sm-2']);
                ?><br>
            </div><br>
            <div class='row'>
                <?php 
                    echo $this->Form->control('date', ['empty' => true, 'label'=> "Fecha:", 'class'=>'form-control col-sm-2']);
                ?><br>
            </div><br>
        
        <div id=assetResult>
        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label>Nombre:  </label>
                <?php 
                    echo $this->Form->imput('name1', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Cédula:  </label>
                <?php 
                    echo $this->Form->imput('identification1', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label >Nombre:</label>
                <?php 
                    echo $this->Form->imput('name2', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Cédula:  </label>
                <?php 
                    echo $this->Form->imput('identification2', ['class'=>'form-control col-sm-6']);
                ?> 
            </div>
          </div>
        </div>

    </fieldset>
    </div>
    
    <style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left: 10px;
    }

    label {
          text-align:left;
          margin-right: 10px;
          
    }
    </style> 

    
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

</div>


