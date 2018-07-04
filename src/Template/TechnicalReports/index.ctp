<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport[]|\Cake\Collection\CollectionInterface $technicalReports
 */
?>
<div class="roles x large-9 medium-8 columns content">
    <h3><?= __('Informe técnico') ?></h3>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
       <table id="technicalReports-grid" class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Identificador') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Recomendación') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($technicalReports as $technicalReport): ?>
                <tr>
                    <td class="actions">
                        <?php if($allowC) : ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $technicalReport->technical_report_id], array('escape' => false)) ?>
                        <?php endif; ?> 
                        <?php if($allowM) : ?>
                            <?php if($technicalReport->file_name == null) : ?> 

                                <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $technicalReport->technical_report_id], array('escape' => false)) ?>
                            <?php endif; ?>         
                        <?php endif; ?> 
                        <?php if($allowE) : ?> 
                            <?php if(($technicalReport->descargado == null) && ($technicalReport->file_name == null )) : ?> 

                            <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $technicalReport->technical_report_id], ['escape' => false, 'confirm' => __('¿Seguro quiere borrar el reporte # '.$technicalReport->technical_report_id.' ?', $technicalReport->technical_report_id)]) ?>
                            <?php endif; ?> 
                        <?php endif; ?> 
                    </td>

                    <td><?= h($technicalReport->facultyInitials."-".$technicalReport->internal_id."-".$technicalReport->year) ?></td>
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
                  <td>
                      <?php if ((null == $technicalReport->file_name) && (null == $technicalReport->descargado)): ?>
                          Pendiente
                      <?php endif; ?>

                      <?php if ((null == $technicalReport->file_name) && (null != $technicalReport->descargado)): ?>
                          Pendiente Aprobación
                      <?php endif; ?>

                      <?php if ((null != $technicalReport->file_name) && (null != $technicalReport->descargado)): ?>
                          Completado
                      <?php endif; ?>
                  </td>

              </tr>
          <?php endforeach; ?>
      </tbody>
       <tfoot>
                    <tr>
                        <td></td>
                        <th>Identificador</th>
                        <th>Fecha</th>
                        <th>Recomendación</th>
                        <th>Estado</th>
                    </tr>

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