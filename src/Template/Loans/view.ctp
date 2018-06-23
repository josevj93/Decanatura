<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loan $loan
 */
?>

<style>
    .btn-primary {
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
        
        .btn-default {
          color: #000;
          background-color: #7DC7EF;
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;
        }
        
        label {
          text-align:left;
          margin-right: 10px;
          
        }

        .sameLine{
          display: flex; 
          justify-content: space-between; 
          border-color: transparent;
        }
        
        .date{
          width:100px;
          margin-left: 10px;
        }
</style> 

<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($loan) ?>
    <fieldset>
        <legend><?= __('Insertar préstamo') ?></legend>
    
        <br>

        <div class="form-control sameLine">
            <div class="row col-lg-5">
                <label> <b>Responsable:</b><b style="color:red;">*</b> </label>
                <?php echo $this->Form->imput('id_responsables', array('class' => 'form-control col-md-8', 'id'=> 'userDropdown', 'disabled')); ?>
            </div>

            <div class="row">
                <label> <b>Fecha inicio:</b><b style="color:red;">*</b> </label>
                <?php echo $this->Form->imput('fecha_inicio', ['class'=>'form-control date', 'value' => date("y-m-d"), 'id'=>'datepicker', 'disabled']); ?>
            </div>
            
            <div class="row">
                <label> <b>Fecha de devolución:</b><b style="color:red;">*</b> </label>
                <?php echo $this->Form->imput('fecha_devolucion', ['class'=>'form-control date', 'id'=>'datepicker2', 'disabled']); ?>
            </div>
            
        </div>
    
    </fieldset>
    <br> <br>
</div>

<div class="related">
    <legend><?= __('Activos prestados') ?></legend>

    <!-- tabla que contiene  datos básicos de activos-->
    <table id='assets-borrowed-grid' cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th class="transfer-h"><?= __('Placa') ?></th>
                <th class="transfer-h"><?= __('Marca') ?></th>
                <th class="transfer-h"><?= __('Modelo') ?></th>
                <th class="transfer-h"><?= __('Serie') ?></th>
            </tr>
        <thead>
        <tbody>
            <?php 
                foreach ($result as $a): ?>
                <tr>
                    <td><?= h($a->plaque) ?></td>
                    <td><?= h($a->brand) ?></td>
                    <td><?= h($a->model) ?></td>  
                    <td><?= h($a->series) ?></td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

</div>

<div>
      <label> Observaciones: </label>
      <?php echo $this->Form->textarea('observations', ['class'=>'form-control col-md-8', 'disabled']); ?>
    </div> <br>

<div class="col-12 text-right">

 <?= $this->Html->link(__('Regresar'), ['controller' => 'Loans', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Html->link(__('Cancelar Préstamo'), ['action' => 'cancel',$loan->id], ['class' => 'btn btn-primary']) ?>    

</div>
