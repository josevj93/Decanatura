<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loan $loan
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
    <h3>Consultar préstamo</h3>
</div>

<div class="users view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Responsable') ?></th>
            <td><?= h($loan->user->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha de inicio') ?></th>
            <td><?= h(date("d-m-Y", strtotime($loan->fecha_inicio))) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha de devolución') ?></th>
            <td><?= h(date("d-m-Y", strtotime($loan->fecha_devolucion))) ?></td>
        </tr>
    </table>
        
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

<div class="col-12 text-right">

 <?= $this->Html->link(__('Regresar'), ['controller' => 'Loans', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Html->link(__('Cancelar Préstamo'), ['action' => 'cancel',$loan->id], ['class' => 'btn btn-primary']) ?>    

</div>
