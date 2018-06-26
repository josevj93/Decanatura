<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset[]|\Cake\Collection\CollectionInterface $assets
 */
?>

<div class="types index content">
    <h3><?= __('Préstamos') ?></h3>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="loans-grid"  class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="actions"><?= __('') ?></th>             
                        <th scope="col"><?= $this->Paginator->sort('Responsable') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Fecha de inicio') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Fecha de devolución') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($loans as $loan): ?>
                        <tr>
                            <td class="actions">
                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $loan->id], array('escape'=> false)) ?>
                            </td>                            
                            <td><?= h($loan->user->nombre . " " . $loan->user->apellido1) ?></td>   
                            <td><?= h($loan->estado) ?></td>                         
                            <td><?= h(date("d-m-Y", strtotime($loan->fecha_inicio))) ?></td>
                            <td><?= $loan->has('fecha_devolucion') ? h(date("d-m-Y", strtotime($loan->fecha_devolucion))) : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <th>Placa</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de devolución</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<br>

<style>
.btn-primary {
  color: #fff;
      margin: 10px;
    margin-top: 15px;
  background-color: #FF9933;
  border-color: #FF9933;
}
</style>

<?= $this->Html->link(__('Insertar Préstamo'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>

<script type="text/javascript">

    $(document).ready(function() {
        $('#loans-grid').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
        // Setup - add a text input to each footer cell
        $('#loans-grid tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
        } );

        // DataTable
        var table = $('#loans-grid').DataTable();

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
