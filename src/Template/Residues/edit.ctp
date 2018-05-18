<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Modificar acta de desecho') ?></legend>
            <div>
                <label>Fecha:</label><br>
                <?php 
                    echo $this->Form->control('date', ['empty' => true]);
                ?><br>
            </div>
            <div>
                <label>Nombre:</label><br>
                <?php 
                    echo $this->Form->control('name1', ['class'=>'form-control col-sm-2']);
                ?><br>
            </div>
            <div>
                <label>Cédula:</label><br>
                <?php 
                    echo $this->Form->control('identification1');
                ?><br>
            </div>
            <div>
                <label>Nombre:</label><br>
                <?php 
                    echo $this->Form->control('name2');
                ?><br>
            </div>
            <div>
                <label>Cédula:</label><br>
                <?php 
                    echo $this->Form->control('identification2');
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

    
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

</div>


