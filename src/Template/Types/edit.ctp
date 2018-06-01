<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

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

<div class="col-md-12 col-sm-12">
    <?= $this->Form->create($type) ?>
    <h3>Editar tipo de activo</h3>
</div>

<br>
    
<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->input('name', array('label' => 'Nombre', 'class' => 'form-control')); ?>   
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->input('description', array('label' => 'Descripción', 'class' => 'form-control')); ?>   
</div>

<?= $this->Html->link(__('Cancelar'), ['controller' => 'Types', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
