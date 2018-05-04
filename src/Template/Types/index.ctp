<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Type $type
 */
?>

<div class="types index large-9 medium-8 columns content">
    <h3><?= __('Tipos') ?></h3>
    <form  method="post" id="cart">
        <table id="types-grid" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Tipo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombre') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($types as $type): ?>
                <tr>
                    <td class="actions">
                        
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $type->type_id], array('escape' => false)) ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $type->type_id], array('escape' => false)) ?>
                        <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $type->type_id], ['escape' => false, 'confirm' => __('Seguro que desea eliminar el tipo de activo # {0}?', $type->type_id)]) ?>
                    </td>
                    <td><?= h($type->type_id) ?></td>
                    <td><?= h($type->name) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>

<style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: left;
      margin-left:10px;
    }
</style>    
</div>
<?= $this->Html->link(__('Insertar Tipo'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#types-grid').DataTable( {} );
    } );
</script>
