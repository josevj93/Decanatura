<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="roles form large-9 medium-8 columns content">
    <?= $this->Form->create($role) ?>
    <h3>Insertar Rol</h3>
    <fieldset>
        <?php
            echo $this->Form->control('nombre', array('type'=> 'text', 'label'=> 'Nombre', 'class' => 'form-control'));
            
        ?>


    <table class="table">
        <tr>
            <th><h5><?= __('Modulo') ?></h5></th>
            <td><h5><?= __('Insertar') ?></h5></td>
            <td><h5><?= __('Modificar') ?></h5></td>
            <td><h5><?= __('Eliminar') ?></h5></td>
            <td><h5><?= __('Consultar') ?></h5></td>
        </tr>
        
      <tr>
            <th><h5><?= __('Desechos') ?></h5></th>

        <?php 
          for ($x = 1; $x < 5; $x++) {
            echo "<td>";
              echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
              echo "</td>";
          } 

        ?>

      </tr>
        
      <tr>
            <th><h5><?= __('Traslados') ?></h5></th>
            

        <?php 
          for ($x = 5; $x < 9; $x++) {
             echo "<td>";
              echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
              echo "</td>";
          } 
        ?>


      </tr>

      <tr>
            <th><h5><?= __('Devoluciones') ?></h5></th>
            
        <?php 
          for ($x = 9; $x < 13; $x++) {

             echo "<td>";
              echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
              echo "</td>";

          } 
        ?>



        </tr>
        
        <tr>
            <th><h5><?= __('Prestamos') ?></h5></th>
            
        <?php 
          for ($x = 13; $x < 17; $x++) {

             echo "<td>";
              echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
              echo "</td>";

          } 
        ?>

        </tr>
        
        <tr>
            <th><h5><?= __('Usuarios') ?></h5></th>
            
        <?php 
          for ($x = 17; $x < 21; $x++) {

             echo "<td>";
              echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
              echo "</td>";
                  } 
        ?>


        </tr>
        
    </table>






    </fieldset>
        <style>
        .btn-primary {
            float: right;
            margin: 20px;
        }
    </style>
    </div>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
