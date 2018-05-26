<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types view large-9 medium-8 columns content">
    <h3>Consultar tipo de activo</h3>

   <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($type->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripción') ?></th>
            <td><?= h($type->description) ?></td>
        </tr>
   </table>





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
</div>

<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $type->type_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el tipo de activo # {0}?', $type->type_id)]) ?>

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $type->type_id], ['class' => 'btn btn-primary']) ?>
    
