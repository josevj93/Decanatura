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
    'url' => array('controller' => 'Roles', 'action' => 'consultar')
    ));
    ?>


    <?php echo $this->Form->input('Editar Rol:', array(
    'name' => 'rol',
    'type' => 'select',
    'class' => 'form-control',
    'options' => $roles, 
    'selected' => 'private'
    )); ?>

    <br><br><?php echo $roles; ?><br><br>

    <?= $this->Form->button(__('Consultar'), ['class' => 'btn btn-primary']) ?>


    <?= $this->Form->end() ?>

  <br><br>
    <?php echo $this->Form->create(false, array(
    'url' => array('controller' => 'Roles', 'action' => 'guardar')
    ));
    ?>

    <table class="table">
    	<tr>
    		<th><h5><?= __('Modulo') ?></h5></th>
    		<td><h5><?= __('Insertar') ?></h5></td>
    		<td><h5><?= __('Modificar') ?></h5></td>
    		<td><h5><?= __('Consultar') ?></h5></td>
    		<td><h5><?= __('Eliminar') ?></h5></td>
    	</tr>
    	<tr>
    		<th><h5><?= __('Desechos') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'desechos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'desechos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'desechos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'desechos[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
        
        <tr>
    		<th><h5><?= __('Traslados') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'traslados[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'traslados[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'traslados[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'traslados[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>

    	<tr>
    		<th><h5><?= __('Devoluciones') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'devoluciones[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'devoluciones[]',  
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'devoluciones[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'devoluciones[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
    	
    	<tr>
    		<th><h5><?= __('Prestamos') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'prestamos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'prestamos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'prestamos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'prestamos[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
    	
    	<tr>
    		<th><h5><?= __('Usuarios') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'usuarios[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'usuarios[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox',
                                  'name' => 'usuarios[]', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'name' => 'usuarios[]',
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
    	
    </table>


    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>



</div>
