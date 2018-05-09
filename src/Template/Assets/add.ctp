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

<div class="assets form large-9 medium-8 columns content">
    <h3>Insertar activo</h3>
    <?= $this->Form->create($asset, ['type' => 'file']) ?>
    <fieldset>

            <?php echo $this->Form->input('plaque',array('type' => 'text','label'=>'Placa', 'class' => 'form-control')); ?>   
            <?php echo $this->Form->control('type_id', array('options' => $types,'label'=>'Tipo', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('brand', array('label'=>'Marca', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('model' , array('label'=>'Modelo', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('series', array('label'=>'Serie', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('description', array('label'=>'Descripcion', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('state', array('label'=>'Estado', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('owner_id', array('label'=>'Dueño', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('responsable_id', array('options' => $users, 'empty' => true,'label'=>'Responsable', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('location_id',  array('options' => $locations,'label'=>'Ubicacion', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('sub_location', array('label'=>'Sub-ubicacion', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('year',  array('label'=>'Año', 'class' => 'form-control')); ?>
            <?php echo $this->Form->control('lendable',  array('label'=>'Prestable', 'class' => 'checkbox')); ?>
            <?php echo $this->Form->control('observations', array('label'=>'Observaciones', 'class' => 'form-control'));?>
            <?php echo $this->Form->hidden('unique_id', array('value' => $random));?>
            <?php echo $this->Form->input('image',['type' => 'file', 'class' => 'form-control']); ?>
        
</div>

<div class="col-12 text-right">
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Types', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
</div>