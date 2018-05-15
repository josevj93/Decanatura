<?php
/**
 * @var \App\View\AppView $this
 *
 *@var \App\Model\Entity\Role $role
 */
?>

<div class="roles x large-9 medium-8 columns content">
    <h1><?= __('Roles') ?></h1>

    <?php echo $this->Form->create(false, array(
        'url' => array('controller' => 'Roles', 'action' => 'index')
    ));
    ?>

    <?php echo $this->Form->input('Editar Rol:', array(

    'name' => 'rol',
    'type' => 'select',
    'class' => 'form-control',
    'options' => $roles, 
    'selected' => 'selected',
    'value' => $rol_activo - 1, 


    <br>

    <?= $this->Form->button(__('Consultar'), ['class' => 'btn btn-primary']) ?>

    <input type="hidden" name="accion" value="1" />


    <?= $this->Form->end() ?>

    <br><br>
    <?php echo $this->Form->create(false, array(
        'url' => array('controller' => 'Roles', 'action' => 'index')
    ));
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
                if ($permisos[$x] == 1) {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'checked'=> true, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                }
            }
            ?>

        </tr>

        <tr>
            <th><h5><?= __('Traslados') ?></h5></th>


            <?php
            for ($x = 5; $x < 9; $x++) {
                if ($permisos[$x] == 1) {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'checked'=> true, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                }
            }
            ?>


        </tr>

        <tr>
            <th><h5><?= __('Devoluciones') ?></h5></th>

            <?php
            for ($x = 9; $x < 13; $x++) {
                if ($permisos[$x] == 1) {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'checked'=> true, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                }
            }
            ?>



        </tr>

        <tr>
            <th><h5><?= __('Prestamos') ?></h5></th>

            <?php
            for ($x = 13; $x < 17; $x++) {
                if ($permisos[$x] == 1) {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'checked'=> true, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                }
            }
            ?>

        </tr>

        <tr>
            <th><h5><?= __('Usuarios') ?></h5></th>

            <?php
            for ($x = 17; $x < 21; $x++) {
                if ($permisos[$x] == 1) {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'checked'=> true, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo $this->Form->input('', array( 'type'=>'checkbox', 'name' => $x, 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
                    echo "</td>";
                }
            }
            ?>


        </tr>

    </table>


    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>

    <input type="hidden" name="accion" value="2" />

    <input type="hidden" name="activo" value= "<?= $rol_activo ?>" />

    <?= $this->Form->end() ?>



</div>
