<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types form large-12 medium-12 columns content">
    <?= $this->Form->create($type) ?>
    <h3>Editar tipo de activo</h3>

<div class="row">
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->input('type_id',array('type' => 'text','label'=>'ID', 'class' => 'form-control')); ?>   
    </div>
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('name', array('label' =>  'Nombre', 'class' => 'form-control')); ?>
    </div>
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?php echo $this->Form->control('description', array('label'=>'Descripcion', 'class' => 'form-control')); ?>
    </div>
</div>




<style>
    .btn-primary {
      margin-top: 15px;
      float: right;
    }
</style> 
</div>

<?= $this->Html->link(__('Cancelar'), ['controller' => 'Types', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
