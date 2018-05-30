
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="users x large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
</div>

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
                        <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                        <!--<th scope="col"><?= $this->Paginator->sort('id_rol') ?></th>-->
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="actions">
                            <?php if($allowC) : ?>
                                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $user->id], array('escape'=> false));?>
                            <?php endif; ?> 

                            <?php if($allowM) : ?>
                                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $user->id],  array('escape'=> false));?>
                            <?php endif; ?>

                            <?php if($allowE) : ?> 
                                    <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $user->id],  ['escape'=> false,'confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]);?>
                            <?php endif; ?> 
                            
                        </td>
                        <!--<td><?= $this->Number->format($user->id) ?></td>-->
                        <td><?= h($user->nombre) ?></td>
                        <td><?= h($user->apellido1) ?></td>
                        <td><?= h($user->apellido2) ?></td>
                        <!--<td><?= h($user->correo) ?></td>-->
                        <td><?= h($user->username) ?></td>
                        <!--<td><?= $this->Number->format($user->id_rol) ?></td>-->
                        <td><?= h($user->account_status == 1 ? 'Activo' : 'Inoperante') ?></td>

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
                    <th>Estado</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php if($allowI) : ?>
<?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<?php endif; ?>

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




