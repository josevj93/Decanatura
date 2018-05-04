<div class="locations view large-9 medium-8 columns content">
    <h3><?= h("Consultar Ubicacion") ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($location->location_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Descripcion') ?></th>
            <td><?= h($location->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($location->nombre) ?></td>
        </tr>
    </table>

<style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left:10px;
    }
</style> 
    
    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $location->location_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar la Ubicación # {0}?', $location->location_id)]) ?>
    <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $location->location_id], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

</div>
