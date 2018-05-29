

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>

<div class="col-md-12 col-sm-12">
    <h3>Insertar préstamo</h3>
    <?= $this->Form->create($loan, ['type' => 'file']) ?>
</div>
<br>
    
<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->input('id',array('type' => 'text','label'=>'ID', 'class' => 'form-control')); ?>   
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_assets', array('options' => $assets,'label'=>'Placa', 'class' => 'form-control')); ?>
</div>

<br>
    
<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_responsables', array('options' => $users,'label'=>'Responsable', 'class' => 'form-control')); ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('fecha_inicio' , array('label'=>'Fecha de Inicio', 'class' => 'form-control')); ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('fecha_devolucion', array('label'=>'Fecha de devolución', 'class' => 'form-control')); ?>
</div>

<br>

<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
    <?php echo $this->Form->control('observaciones', array('label'=>'Observaciones', 'class' => 'form-control', 'rows' => '3')); ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12"> 
    <?php  echo $this->Form->control('estado', array('label'=>'Estado', 'class' => 'form-control')); ?>
</div>

<br>

<div class="col-12 text-right">

    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Loans', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    
</div>