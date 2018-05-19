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
                <th scope="col"><?= $this->Paginator->sort('Marca') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Modelo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Serie') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Descripción') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
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
               
                    <td><?= h($asset->brand) ?></td>
                
                    <td><?= h($asset->model) ?></td>
                    <td><?= h($asset->series) ?></td>
                    <td><?= h($asset->description) ?></td>
                    <td><?= h($asset->state) ?></td>
                    <td><?= $this->Number->format($asset->owner_id) ?></td>
                    
                    <td><?= $asset->has('location') ? $this->Html->link($asset->location->location_id, ['controller' => 'Locations', 'action' => 'view', $asset->location->location_id]) : '' ?></td>
                
                    <td><?= $this->Number->format($asset->year) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>


   
</div>

            <style>
        .btn-primary {
            float: left;
            margin: 20px;
            color: #fff;
            background-color: #F2A32C;
            border-color: #F2A32C;
        }
    </style> 
<?= $this->Html->link(__('Insertar Activo'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#assets-grid').DataTable( {} );
    } );
</script>
