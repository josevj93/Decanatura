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
        <li><?= $this->Form->postLink(
                __('Eliminar'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('¿Está seguro que desea eliminar este usuario? # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Lista Usuarios'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Editar Usuario') ?></legend>
        <?php
            echo $this->Form->control('nombre');
            echo $this->Form->control('apellido1');
            echo $this->Form->control('apellido2');
            echo $this->Form->control('correo');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('id_rol');
        ?>
    </fieldset>
    &nbsp;
    <?= $this->Form->button(__('Aceptar')) ?>
    <?= $this->Form->end() ?>
</div>
=======
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <h3>Modificar Usuario</h3>
    <fieldset>
        <?php
            echo $this->Form->input('nombre', array('type'=> 'text', 'label'=> 'Nombre', 'class' => 'form-control'));
            echo $this->Form->input('apellido1', array('type'=> 'text', 'label'=> 'Apellido 1', 'class' => 'form-control'));
            echo $this->Form->input('apellido2', array('type'=> 'text', 'label'=> 'Apellido 2', 'class' => 'form-control'));
            echo $this->Form->input('correo', array('type'=> 'text', 'label'=> 'Correo', 'class' => 'form-control'));
            echo $this->Form->input('username', array('type'=> 'text', 'label'=> 'Usuario', 'class' => 'form-control'));
            echo $this->Form->input('password', array('type'=> 'password', 'label'=> 'Contraseña', 'class' => 'form-control'));
            echo $this->Form->input('id_rol', array('type' => 'select','class' => 'form-control','options' => array('1' => 'Administrador', '2' => 'Estudiante', '3' => 'Director de la Escuela'), 'selected' => 'private'));
        ?>
    <style>
        .btn-primary {
            float: right;
            margin: 20px;
        }
    </style> 
    </div>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
>>>>>>> origin/Develop
