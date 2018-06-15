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
    <h3>Insertar activos por Lotes</h3>
    <?= $this->Form->create($asset, ['type' => 'file']) ?>
</div>

<div class="row">

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->input('plaque',array('type' => 'text','label'=>'Placa Inicial', 'class' => 'form-control')); ?>   
    </div>

        <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->input('quantity',array('type' => 'text','label'=>'Cantidad', 'class' => 'form-control')); ?>   
    </div>
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('type_id', array('options' => $types,'label'=>'Tipo', 'class' => 'form-control')); ?>
    </div>
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('brand', array('label'=>'Marca', 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('model' , array('label'=>'Modelo', 'class' => 'form-control')); ?>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('description', array('label'=>'Descripcion', 'class' => 'form-control')); ?>
    </div>
</div>    

<div class="row">
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('state', array('label'=>'Estado', 'class' => 'form-control')); ?>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('owner_id', array('label'=>'Dueño', 'class' => 'form-control')); ?>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('responsable_id', array('options' => $users, 'empty' => true,'label'=>'Responsable', 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('location_id',  array('options' => $locations,'label'=>'Ubicacion', 'class' => 'form-control')); ?>
    </div>
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">    
        <?php echo $this->Form->control('sub_location', array('label'=>'Sub-ubicacion', 'class' => 'form-control')); ?>
    </div>    
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">    
        <?php echo $this->Form->control('year',  array('label'=>'Año', 'class' => 'form-control')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <?php echo $this->Form->control('lendable',  array('label'=>'Prestable', 'class' => 'checkbox')); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">                         
        <?php echo $this->Form->control('observations', array('label'=>'Observaciones', 'class' => 'form-control'));?>
    </div>
</div>

<?php echo $this->Form->hidden('unique_id', array('value' => $random));?>
     

<br>

<div class="col-12 text-right">
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Assets', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
</div>