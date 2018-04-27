<h1>Tipos de activo</h1>
<?= $this->Html->link(
    'Añadir artículo',
    ['controller' => 'Types', 'action' => 'add']
) ?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acción</th>
    </tr>

    <!-- Aquí es donde iteramos nuestro objeto de consulta $types, mostrando en pantalla la información del type -->

  <?php foreach ($types as $type): ?>
    <tr>
         <td>
           <?= $this->Html->link($type->type_id,
            ['controller' => 'Types', 'action' => 'view', $type->type_id]) ?>
       </td>
 
            <td><?= $type->name ?></td>
        
        <td><?= $type->description ?></td>
       <td>
            <?= $this->Form->postLink(
                'Eliminar',
                ['action' => 'delete', $type->type_id],
                ['confirm' => '¿Estás seguro?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>