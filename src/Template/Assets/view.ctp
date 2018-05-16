<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<<<<<<< HEAD
<div class="assets view large-9 medium-8 columns content">
    <h3>Consultar activo</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Placa') ?></th>
            <td><?= h($asset->plaque) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Marca') ?></th>
            <td><?= h($asset->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelo') ?></th>
            <td><?= h($asset->model) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Serie') ?></th>
            <td><?= h($asset->series) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripción') ?></th>
            <td><?= h($asset->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($asset->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsable') ?></th>
            <td><?= $asset->has('user') ? $this->Html->link($asset->user->id, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ubicación') ?></th>
            <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub-ubicación') ?></th>
            <td><?= h($asset->sub_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dueño') ?></th>
            <td><?= $this->Number->format($asset->owner_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Año') ?></th>
            <td><?= $this->Number->format($asset->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prestable') ?></th>
            <td><?= $asset->lendable ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($asset->observations) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Imagen') ?></th>
            <td><?= $this->Html->image('../files/Assets/image/' . $asset->uniqid . '/' . $asset->image) ?></td>
        </tr>
    </table>
=======
<div class="col-md-12 col-sm-12">
    <h3>Consultar activo</h3>


    <div class="row">
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Placa') ?>
        <br>
        <br>
        <?= h($asset->plaque) ?>
        <br>
        <br>
    </div>
    
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Tipo') ?>
        <br>
        <br>
        <?= $asset->has('type_id') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?>
        <br>
        <br>
    </div>
        
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Marca') ?>
        <br>
        <br>
        <?= h($asset->brand) ?>
        <br>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Modelo') ?>
        <br>
        <br>
        <?= h($asset->model) ?>
        <br>
        <br>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Serie') ?>
        <br>
        <br>
        <?= h($asset->series) ?>
        <br>
        <br>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Description') ?>
        <br>
        <br>
        <?= h($asset->description) ?>
        <br>
        <br>
    </div>
</div>    

<div class="row">
    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Estado') ?>
        <br>
        <br>
        <?= h($asset->state) ?>
        <br>
        <br>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Dueño') ?>
        <br>
        <br>
        <?= $this->Number->format($asset->owner_id) ?>
        <br>
        <br>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
        <?= __('Responsable') ?>
        <br>
        <br>
        <?= $asset->has('user') ? $this->Html->link($asset->user->id, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?>
        <br>
        <br>
    </div>
</div>


<div class="row">
       <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
         <?= __('Ubicación') ?>
        <br>
        <br>
      <?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?>
        <br>
        <br>
         
         <?= __('Sub-ubicación') ?>
        <br>
        <br>
        <?= h($asset->sub_location) ?>
        <br>
        <br>
        <?= __('Año') ?>
        <br>
        <br>
        <?= $this->Number->format($asset->year) ?>
        <br>
        <br>
    </div>

    <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
           <?= __('Prestable') ?>
        <br>
        <br>
        <?= $asset->lendable ? __('Yes') : __('No'); ?>
        <br>
        <br>
                     
        <?= __('Observaciones') ?>
        <br>
        <br>
        <?= h($asset->observations) ?>
        <br>
        <br>


                <?= __('Imagen') ?>
        <br>
        <br>
        <?= $this->Html->image('/webroot/files/Assets/image/' . $asset->unique_id . '/' . 'thumbnail.png') ?>
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
<?= $this->Form->postLink('Eliminar', array('action' => 'delete', $asset->plaque), array('class' => 'btn btn-primary') , array('Seguro que desea eliminar la Ubicación # {0}?', $asset->plaque)) ?>
=======
<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $asset->plaque], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el activo # {0}?', $asset->plaque)]) ?>
>>>>>>> origin/Develop

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $asset->plaque], ['class' => 'btn btn-primary']) ?>
    
<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
