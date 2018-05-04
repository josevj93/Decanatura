<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types view large-9 medium-8 columns content">
    <h3>Consultar</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= h($type->type_id) ?></td>
        </tr>
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
    }
</style>    
</div>
<?= $this->Form->postLink('Eliminar', array('action' => 'delete', $type->type_id), array('class' => 'btn btn-primary') , array('Seguro que desea eliminar la Ubicación # {0}?', $type->type_id)) ?>

<?= $this->Html->link(__('Modificar'), ['action' => 'edit', $type->type_id], ['class' => 'btn btn-primary']) ?>
    
<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
