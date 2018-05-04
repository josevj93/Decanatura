<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $roles
 */
?>

<div class="roles index large-9 medium-8 columns content">
    <h1><?= __('Roles') ?></h1>

    <?php echo $this->Form->input('Rol', array(
    'type' => 'select', 
    'options' => array('estudiante' => 'Estudiante', 'director' => 'Director de Escuela', 'administrador' => 'Administrador'), 
    'selected' => 'private'
)); ?>


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
    	
    </table>
</div>

