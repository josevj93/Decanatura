
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="users-grid"  class="table table-striped">
                <thead>
                    <tr>
                        <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                        <th scope="col" class="actions"><?= __('') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Apellido 1') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('Apellido 2') ?></th>
                        <!--<th scope="col"><?= $this->Paginator->sort('Correo') ?></th>-->
                        <th scope="col"><?= $this->Paginator->sort('Usuario') ?></th>
                        <!--<th scope="col"><?= $this->Paginator->sort('password') ?></th>-->
                        <!--<th scope="col"><?= $this->Paginator->sort('id_rol') ?></th>-->
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="actions">
                            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $user->id], array('escape'=> false)) ?>
                            <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $user->id],  array('escape'=> false)) ?>
                            <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $user->id],  ['escape'=> false,'confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]) ?>
                        </td>
                        <!--<td><?= $this->Number->format($user->id) ?></td>-->
                        <td><?= h($user->nombre) ?></td>
                        <td><?= h($user->apellido1) ?></td>
                        <td><?= h($user->apellido2) ?></td>
                        <!--<td><?= h($user->correo) ?></td>-->
                        <td><?= h($user->username) ?></td>
                        <!--<td><?= h($user->password) ?></td>-->
                        <!--<td><?= $this->Number->format($user->id_rol) ?></td>-->

                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Apellido2</th>
                    <th>Usuario</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>


<script type="text/javascript">

    $(document).ready(function() {
        $('#users-grid').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
        // Setup - add a text input to each footer cell
        $('#users-grid tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
        } );

        // DataTable
        var table = $('#users-grid').DataTable();

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




