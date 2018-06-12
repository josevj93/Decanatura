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
            <th scope="row"><?= __('Placa') ?></th>
            <td><?= h($loan->id_assets) ?></td>
        </tr>
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

<div class="col-12 text-right">

 <?= $this->Html->link(__('Regresar'), ['controller' => 'Loans', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Html->link(__('Cancelar Préstamo'), ['action' => 'cancel',$loan->id], ['class' => 'btn btn-primary']) ?>    

</div>