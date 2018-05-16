<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset[]|\Cake\Collection\CollectionInterface $assets
 */
?>

<div class="types index large-9 medium-8 columns content">
    <h3><?= __('Activos') ?></h3>
    <form  method="post" id="cart">
        <table id="assets-grid" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Placa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Tipo') ?></th>                
                <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Descripción') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Responsable') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Ubicación') ?></th>                
                <th scope="col"><?= $this->Paginator->sort('Año') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assets as $asset): ?>
                <tr>
                    <td class="actions">
                        
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $asset->plaque], array('escape' => false)) ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $asset->plaque], array('escape' => false)) ?>
                        <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $asset->plaque], ['escape' => false, 'confirm' => __('Seguro que desea eliminar el activo # {0}?', $asset->plaque)]) ?>
                    </td>                       
                    <td><?= h($asset->plaque) ?></td>
                    <td><?= $asset->has('type') ? $this->Html->link($asset->type->name, ['controller' => 'Types', 'action' => 'view', $asset->type->type_id]) : '' ?></td>
                    <td><?= h($asset->brand) ?></td>
                
                
                    <td><?= h($asset->description) ?></td>
                
                    <td><?= $this->Number->format($asset->owner_id) ?></td>
                    
                    <td><?= $asset->has('location') ? $this->Html->link($asset->location->nombre, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
                
                    <td><?= h($asset->year)?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
   
</div>
<?= $this->Html->link(__('Insertar Activo'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#assets-grid').DataTable( {} );
    } );
</script>
