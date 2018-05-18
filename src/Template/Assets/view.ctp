<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<div class="users view large-9 medium-8 columns content">
    <h3>Consultar Activo</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Placa') ?></th>
            <td><?= h($asset->plaque) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($asset->type_id) ?></td>
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
            <th scope="row"><?= __('Dueño') ?></th>
            <td><?= h($asset->owner_id) ?></td>
        </tr>

           <tr>
            <th scope="row"><?= __('Responsable') ?></th>
            <td><?= h($asset->responsable_id) ?></td>
        </tr>


           <tr>
            <th scope="row"><?= __('Ubicación') ?></th>
            <td><?= h($asset->location_id) ?></td>
        </tr>

           <tr>
            <th scope="row"><?= __('Sub-ubicación') ?></th>
            <td><?= h($asset->sub_location) ?></td>
        </tr>

            <tr>
            <th scope="row"><?= __('Observaciones') ?></th>
            <td><?= h($asset->observations) ?></td>
        </tr>

            <tr>
            <th scope="row"><?= __('Año') ?></th>
            <td><?= h($asset->year) ?></td>
        </tr>


            <tr>
            <th scope="row"><?= __('Imagen') ?></th>
            <td><?= $this->Html->image('/webroot/files/Assets/image/' . $asset->unique_id . '/' . 'thumbnail.png') ?></td>
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
<?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $asset->plaque], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar el activo # {0}?', $asset->plaque)]) ?>

<?= $this->Html->link(__('Editar'), ['action' => 'edit', $asset->plaque], ['class' => 'btn btn-primary']) ?>
    
<?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
