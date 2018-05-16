<<<<<<< HEAD
=======

>>>>>>> origin/Develop
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<<<<<<< HEAD
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add']) ?></li>
    </ul>
</nav>


 
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!--<th scope="col"><?= $this->Paginator->sort('id') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellido1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('apellido2') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('correo') ?></th>-->
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <!--<th scope="col"><?= $this->Paginator->sort('password') ?></th>-->
                <!--<th scope="col"><?= $this->Paginator->sort('id_rol') ?></th>-->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
=======

<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
    <form method="post" id="cart">
    <table id="users-grind" cellpadding="0" cellspacing="0">
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
>>>>>>> origin/Develop
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
<<<<<<< HEAD
=======
                <td class="actions">
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $user->id], array('escape'=> false)) ?>
                    <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $user->id],  array('escape'=> false)) ?>
                    <?= $this->Form->postLink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $user->id],  ['escape'=> false,'confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]) ?>
                </td>
>>>>>>> origin/Develop
                <!--<td><?= $this->Number->format($user->id) ?></td>-->
                <td><?= h($user->nombre) ?></td>
                <td><?= h($user->apellido1) ?></td>
                <td><?= h($user->apellido2) ?></td>
                <!--<td><?= h($user->correo) ?></td>-->
                <td><?= h($user->username) ?></td>
                <!--<td><?= h($user->password) ?></td>-->
                <!--<td><?= $this->Number->format($user->id_rol) ?></td>-->
<<<<<<< HEAD
                <td class="actions">
                    <?= $this->Html->link(__('Consultar'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $user->id], ['confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]) ?>
                </td>
=======
                
>>>>>>> origin/Develop
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<<<<<<< HEAD
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primero')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

=======
</form>
        <style>
        .btn-primary {
            float: left;
            margin: 20px;
            color: #fff;
            background-color: #F2A32C;
            border-color: #F2A32C;
        }
    </style> 
</div>

<?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#users-grid').DataTable( {} );
    } );
</script>

>>>>>>> origin/Develop
