<h2>Añadir Tipo</h2>
<?php
    echo $this->Form->create($type);
    echo $this->Form->input('type_id', array('type' => 'text'));
    echo $this->Form->input('name');
     echo $this->Form->input('description');

    echo $this->Form->button(__('Guardar tipo'));
    echo $this->Form->end();
?>


<?= $this->Html->link('Regresar', ['action' => 'index']) ?> 