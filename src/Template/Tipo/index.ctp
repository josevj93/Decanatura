<h1>Tipos de activo</h1>
<?= $this->Html->link(
    'Añadir artículo',
    ['controller' => 'Tipo', 'action' => 'add']
) ?>
<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acción</th>
    </tr>

    <!-- Aquí es donde iteramos nuestro objeto de consulta $tipos, mostrando en pantalla la información del tipo -->

  <?php foreach ($tipos as $tipo): ?>
    <tr>
         <td>
           <?= $this->Html->link($tipo->id_tipo,
            ['controller' => 'Tipo', 'action' => 'view', $tipo->id_tipo]) ?>
       </td>
 
            <td><?= $tipo->nombre ?></td>
        
        <td><?= $tipo->descripcion ?></td>
       <td>
            <?= $this->Form->postLink(
                'Eliminar',
                ['action' => 'delete', $tipo->id_tipo],
                ['confirm' => '¿Estás seguro?'])
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>