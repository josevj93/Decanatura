<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types index content">
    <h3><?= __('Tipos de activos') ?></h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="types-grid"  class="table table-striped">
                
                <thead>
                    <tr>
                        <th scope="col" class="actions"><?= __('') ?></th>  
                        <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Descripción') ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($types as $type): ?>
                        <tr>
                            <td class="actions">
                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $type->type_id], array('escape'=> false)) ?>
                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $type->type_id],  array('escape'=> false)) ?>
                                <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $type->type_id],  ['escape'=> false,'confirm' => __('¿Está seguro que desea eliminar este tipo de activo? # {0}?', $type->type_id)]) ?>
                            </td>
                            <td><?= h($type->name) ?></td>
                            <td><?= h($type->description) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
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

<?= $this->Html->link(__('Insertar Tipo'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>

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
