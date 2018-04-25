<h2>Añadir Tipo</h2>
<?php
    echo $this->Form->create($tipo);
    echo $this->Form->input('id_tipo', array('type' => 'text'));
    echo $this->Form->input('nombre');
     echo $this->Form->input('descripcion');

    echo $this->Form->button(__('Guardar tipo'));
    echo $this->Form->end();
?>


<?= $this->Html->link('Regresar', ['action' => 'index']) ?> 