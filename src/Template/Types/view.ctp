<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<<<<<<< HEAD
<div class="types view large-9 medium-8 columns content">
    <h3>Consultar tipo de activo</h3>
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
=======
<div class="types view large-12 medium-12 columns content">
    <h3>Consultar tipo de activo</h3>

  <div class="row">
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('ID') ?>
        <br>
        <br>
         <td><?= h($type->type_id) ?></td>
        <br>
        <br>
    </div>
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Nombre') ?>
        <br>
        <br>
        <td><?= h($type->name) ?></td>
        <br>
        <br>
    </div>
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Descripcion') ?>
        <br>
        <br>
          <td><?= h($type->description) ?></td>
        <br>
        <br>
    </div>
</div>




>>>>>>> origin/Develop

<style>
    .btn-primary {
      float: right;
    }
</style>    
</div>
<<<<<<< HEAD
<?= $this->Form->postLink('Eliminar', array('action' => 'delete', $type->type_id), array('class' => 'btn btn-primary') , array('Seguro que desea eliminar la Ubicación # {0}?', $type->type_id)) ?>
=======
<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $type->type_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el tipo de activo # {0}?', $type->type_id)]) ?>
>>>>>>> origin/Develop

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $type->type_id], ['class' => 'btn btn-primary']) ?>
    
<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
