<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Brand $brand
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
    <?= $this->Form->create($brand) ?>
    <h3>Insertar marca</h3>
</div>

<br>
    
<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->input('name', array('label' => 'Nombre', 'class' => 'form-control')); ?>   
</div>


<?= $this->Html->link(__('Cancelar'), ['controller' => 'Brands', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    
