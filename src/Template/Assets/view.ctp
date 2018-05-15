<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
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



<style>
    .btn-primary {
      float: right;
    }
</style>    
</div>
<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $asset->plaque], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el activo # {0}?', $asset->plaque)]) ?>

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $asset->plaque], ['class' => 'btn btn-primary']) ?>
    
<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
