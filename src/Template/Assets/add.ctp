<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>

<!-- Genera un id unico para el campo unique_id con el que se guardaran las imagenes en webroot -->
<?php 
$random = uniqid();
?>

<div class="col-md-12 col-sm-12">
    <h3>Insertar activo</h3>
    <?= $this->Form->create($asset, ['type' => 'file']) ?>
</div>
<br>
    
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->input('plaque',array('type' => 'text','label'=>'Placa', 'class' => 'form-control')); ?>   
    </div>
    <br>
    
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('type_id', array('options' => $types,'label'=>'Tipo', 'class' => 'form-control')); ?>
    </div>
         <br>
        
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('brand', array('label'=>'Marca', 'class' => 'form-control')); ?>
    </div>
  <br>
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('model' , array('label'=>'Modelo', 'class' => 'form-control')); ?>
    </div>
      <br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('series', array('label'=>'Serie', 'class' => 'form-control')); ?>
    </div>
<br>
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('description', array('label'=>'Descripcion', 'class' => 'form-control', 'rows' => '3')); ?>
    </div>
    <br>

  <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12"> 
        <?php  echo $this->Form->control('state', array('label'=>'Estado', 'class' => 'form-control', 'type' => 'select', 'options' => array('Activo' => 'Activo','Trasladado' => 'Trasladado', 'Desechado' => 'Desechado'), 'selected' => 'private')); ?> 

    </div>
      <br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('owner_id', array('label'=>'Dueño', 'class' => 'form-control')); ?>
    </div>
      <br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('responsable_id', array('options' => $users, 'empty' => true,'label'=>'Responsable', 'class' => 'form-control')); ?>
    </div>
  <br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('location_id',  array('options' => $locations,'label'=>'Ubicacion', 'class' => 'form-control')); ?>
    </div>
          <br>
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">    
        <?php echo $this->Form->control('sub_location', array('label'=>'Sub-ubicacion', 'class' => 'form-control')); ?>
    </div>    
        <br>
    <!--<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">    
        <?php // echo $this->Form->control('year',  array('label'=>'Año', 'class' => 'form-control')); ?>
    </div>-->

<br>
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('lendable',  array('label'=>'Prestable', 'class' => 'checkbox')); ?>
    </div>
      <br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">                         
        <?php echo $this->Form->control('observations', array('label'=>'Observaciones', 'class' => 'form-control'));?>
    </div>
  <br>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->input('image',['label'=>'Imagen', 'type' => 'file', 'class' => 'form-control']); ?>
    </div>
<br>

    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">                         
        <?php echo $this->Form->control('unique_id', array('type' => 'text','label'=>'Nombre foto', 'class' => 'form-control'));?>
    </div>
  <br>

<div class="col-12 text-right">

    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Assets', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    
</div>
<br>