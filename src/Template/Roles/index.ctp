<?php
/**
 * @var \App\View\AppView $this
 * 
 *@var \App\Model\Entity\Role $role
 */
?>



<div class="roles x large-9 medium-8 columns content">
    <h1><?= __('Roles') ?></h1>

    <?php echo $this->Form->create(); ?>


    <?php echo $this->Form->input('Editar Rol:', array(
    'type' => 'select',
    'class' => 'form-control',
    'options' => $roles, 
    'selected' => 'private'
    )); ?>


    <?= $this->Form->end() ?>

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
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
        
        <tr>
    		<th><h5><?= __('Traslados') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>

    	<tr>
    		<th><h5><?= __('Devoluciones') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    	</tr>
    	
    	<tr>
    		<th><h5><?= __('Prestamos') ?></h5></th>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
                                  'format' => array('before', 'input', 'between', 'label', 'after', 'error' ) 
  ) ); ?>
    		</td>
    		<td>
    			<?php echo $this->Form->input('', array(
                                  'type'=>'checkbox', 
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


    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->end() ?>



</div>
