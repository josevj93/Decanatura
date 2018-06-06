<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Brand[]|\Cake\Collection\CollectionInterface $brands
 */
?>
<div class="brands index content">
    <h3><?= __('Marcas de activos') ?></h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="types-grid"  class="table table-striped">
                
                <thead>
                    <tr>
                        <th scope="col" class="actions"><?= __('') ?></th>  
                        <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($brands as $brand): ?>
                        <tr>
                            <td class="actions">
                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $brand->id],  array('escape'=> false)) ?>
                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $brand->id],  ['escape'=> false,'confirm' => __('¿Está seguro que desea eliminar esta marca? # {0}?', $brand->id)]) ?>
                            </td>
                            <td><?= h($brand->name) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <th>Nombre</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>

<style>
.btn-primary {
  color: #fff;
  background-color: #FF9933;
  border-color: #FF9933;
}
</style>

<?= $this->Html->link(__('Insertar Marca'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>

<script type="text/javascript">

    $(document).ready(function() {
        $('#types-grid').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
        // Setup - add a text input to each footer cell
        $('#types-grid tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
        } );

        // DataTable
        var table = $('#types-grid').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    } );

</script>