<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Model $model
 */
?>
<div class="col-md-12 col-sm-12">
    <h3>Insertar modelo</h3>
    <?= $this->Form->create($model, ['type' => 'file']) ?>
</div>
<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('name', array('label'=>'Nombre', 'class' => 'form-control')); ?>
</div>
<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_brand', array('options' => $brands,'label'=>'Marca', 'class' => 'form-control')); ?>
</div>
<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_type', array('options' => $types,'label'=>'Tipo', 'class' => 'form-control')); ?>
</div>
<br>

<div class="col-12 text-right">

<?= $this->Html->link(__('Cancelar'), ['controller' => 'Models', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    
    
</div>

   <style>
        .btn-primary {
            float: right;
            margin: 10px;
            margin-top: 15px;
            color: #fff
            background-color: #ffc107;
            border-color: #ffc107;
        }
   </style> 
