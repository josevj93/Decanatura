<div class="locations index large-9 medium-8 columns content">
    <h3><?= __('Ubicaciones') ?></h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="locations-grid" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="actions"><?= __('Acciones') ?></th>

                        <th scope="col"><?= $this->Paginator->sort('Ubicación') ?></th>

                        <th scope="col"><?= $this->Paginator->sort('Descripción') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($locations as $location): ?>
                        <tr>
                            <td class="actions">
                                
                                <?php if($allowC) : ?>
                                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $location->location_id], array('escape' => false)) ?>
                                <?php endif; ?>

                                <?php if($allowM) : ?>
                                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $location->location_id], array('escape' => false)) ?>
                                <?php endif; ?>
                                
                                <?php if($allowE) : ?>
                                    <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $location->location_id], ['escape' => false, 'confirm' => __('Seguro que desea eliminar la Ubicación # {0}?', $location->location_id)]) ?>
                                <?php endif; ?>

                            </td>

                            <td><?= h($location->nombre) ?></td>
                            <td><?= h($location->description) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <th>Ubicación</th>
                        <th>Descripción</th>
                    </tr>

                </tfoot>
            </table>
        </form>
<style>
.btn-primary {
  color: #fff;
  background-color: #FF9933;
  border-color: #FF9933;
  
}
</style>    
</div>
<?= $this->Html->link(__('Insertar Ubicación'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#locations-grid').DataTable( {} );
    } );
</script>