<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="users view large-9 medium-8 columns content">
    <h3>Consultar Usuario</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($user->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido1') ?></th>
            <td><?= h($user->apellido1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellido2') ?></th>
            <td><?= h($user->apellido2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correo') ?></th>
            <td><?= h($user->correo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
    <!--
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    -->
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= $this->Number->format($user->id_rol) ?></td>
        </tr>
		<tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= $this->Number->format($user->personal_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $user->account_status ? __('Activo') : __('Inoperante'); ?></td>
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
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Modificar'), ['controller' => 'Users', 'action' => 'edit'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Eliminar'), ['controller' => 'Users', 'action' => 'delete'], ['class' => 'btn btn-primary']) ?>

