<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Model $model
 */
?>

<div class="models view large-9 medium-8 columns content">
    <h3><?= h($model->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= h($model->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($model->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($model->brand->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($model->type->name) ?></td>
        </tr>
    </table>
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

<div class="col-12 text-right">

<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $model->id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el modelo "{0}" ?', $model->name)]) ?>

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $model->id], ['class' => 'btn btn-primary']) ?>
    

</div>