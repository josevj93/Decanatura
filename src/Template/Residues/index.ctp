<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue[]|\Cake\Collection\CollectionInterface $residues
 */
$mysqli = new mysqli('decanatura.mysql.database.azure.com','ecci@decanatura','Gaby1234','decanatura');
?>
<div class="residues index large-9 medium-8 columns content">
    <h3><?= __('Actas de Desechos') ?></h3>
    <form  method="post" id="cart">
        <table id="residues-grid" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('N° Autorización') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Recomendación') ?></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($residues as $residuess): ?>
                <tr>
                    <td class="actions">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $residuess->residues_id], array('escape' => false)) ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $residuess->residues_id], array('escape' => false)) ?>
                        <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $residuess->residues_id], ['escape' => false, 'confirm' => __('¿Seguro quiere borrar el reporte # '.$residuess->residues_id.' ?', $residuess->residues_id)]) ?>
                    </td>
                    <td><?= h($residuess->residues_id ) ?></td>  
                    <td><?= h($residuess->date ) ?></td>

                    <td><?php
                        //consulta para obtener la recomendación que proviene del informe técnico (no potimizada)
                        $query =  "select  technical_reports.recommendation from residues, assets, technical_reports
                            where residues.residues_id = '11' and residues.residues_id = assets.residues_id and technical_reports.assets_id = assets.plaque
                            order by technical_reports.date desc limit 1;";
                        $result = $mysqli->query($query);

                        foreach ($result as $fila)
                        {
                        if("U"==$fila['recommendation']):
                          echo 'Reubicar';
                        endif;
                        if("P"==$fila['recommendation']):
                          echo 'Reparar';
                        endif;
                        if("E"==$fila['recommendation']):
                          echo 'Desechar';
                        endif;
                        if("D"==$fila['recommendation']):
                          echo 'Usar Piesas';
                        endif;
                        if("O"==$fila['recommendation']):
                          echo 'Otros';
                        endif;
                        }
                        ?></td>  
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    
</div>


<style>
.btn-primary {
  color: #fff;
  background-color: #FF9933;
  border-color: #FF9933;
}
</style>

<?= $this->Html->link(__('Insertar Acta'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#residues-grid').DataTable( {} );
    } );
</script>