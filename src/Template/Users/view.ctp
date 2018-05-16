<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<<<<<<< HEAD
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Acciones') ?></li>
        <li><?= $this->Html->link(__('Editar Usuario'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Eliminar Usuario'), ['action' => 'delete', $user->id], ['confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('Lista Usuarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
=======

<div class="users view large-9 medium-8 columns content">
    <h3>Consultar Usuario</h3>
>>>>>>> origin/Develop
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
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
    -->
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
    </table>
<<<<<<< HEAD
</div>
=======
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

>>>>>>> origin/Develop
