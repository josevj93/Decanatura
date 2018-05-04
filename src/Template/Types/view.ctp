<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
      
        <li><?= $this->Html->link(__('Lista Activos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Lista Tipos'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'edit', $type->type_id]) ?> </li>
       
    </ul>
</nav>

<div class="types view large-9 medium-8 columns content">
    <h3>Consultar</h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ID') ?></th>
            <td><?= h($type->type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($type->name) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descripción') ?></h4>
        <?= $this->Text->autoParagraph(h($type->description)); ?>
    </div>
</div>
