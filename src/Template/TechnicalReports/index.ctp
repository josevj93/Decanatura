<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport[]|\Cake\Collection\CollectionInterface $technicalReports
 */
?>
<div class="technicalReports index large-9 medium-8 columns content">
    <h3><?= __('Reportes técnicos') ?></h3>
    <form  method="post" id="cart">
        <table id="technicalReports-grid" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="actions"><?= __('Acciones') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Recomendación') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($technicalReports as $technicalReport): ?>
                <tr>
                    <td class="actions">
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $technicalReport->technical_report_id], array('escape' => false)) ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $technicalReport->technical_report_id], array('escape' => false)) ?>
                        <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $technicalReport->technical_report_id], ['escape' => false, 'confirm' => __('¿Seguro quiere borrar el reporte # '.$technicalReport->technical_report_id.' ?', $technicalReport->technical_report_id)]) ?>
                    </td>

                    <td><?= h($technicalReport->date ) ?></td>


                    <td>
                        <?php if ("C"==$technicalReport->recommendation): ?>
                          Reubicar
                        <?php endif; ?>

                        <?php if("R"==$technicalReport->recommendation): ?>
                          Reparar
                        <?php endif; ?>

                        <?php if("D"==$technicalReport->recommendation): ?>
                          Desechar
                        <?php endif; ?>

                        <?php if("U"==$technicalReport->recommendation): ?>
                          Usar piesas
                        <?php endif; ?>

                        <?php if("O"==$technicalReport->recommendation): ?>
                          Otros
                        <?php endif; ?>

                    </td>           

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


<?= $this->Html->link(__('Insertar informe técnico'), ['action' => 'add'] ,['class' => 'btn btn-primary']) ?>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#technicalReports-grid').DataTable( {} );
    } );
</script>