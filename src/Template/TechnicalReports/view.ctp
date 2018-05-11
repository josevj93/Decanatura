<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */



?>
<style>
.modal-header-primary {
    color:#fff;
    padding:9px 15px;
    border-bottom:1px solid #eee;
    background-color: #428bca;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
     border-top-left-radius: 5px;
     border-top-right-radius: 5px;
}

.btn-default {
  border-color: #FFFFFF;
}

.btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left:10px;
}
</style>



<div class="technicalReports view large-9 medium-8 columns content">
    <legend>Reporte técnico</legend>
            <br>
            <div>
                <label>Reporte Nº:</label><br>
                <?php echo '<input type="text" class="form-control col-sm-2" readonly="readonly" name="id" value="' . htmlspecialchars($technicalReport->technical_report_id) . '">'; ?>     
            </div>
            <br>

            <div>
                <label >Fecha:</label><br>
                <?php echo '<input type="text" class="form-control col-sm-2" readonly="readonly" name="fecha" value="' . htmlspecialchars($technicalReport->date) . '">'; ?>     
            </div>
            <br>

            <div>
                <label>Placa del activo:</label><br>
                <?php echo $this->Html->link($technicalReport->asset->plaque, '#list', array(
                                      'data-toggle' => 'modal',
                                        'class' => 'btn btn-default'
                                    )); ?>
            </div><br>

            <div class="modal fade" id="list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

             <div class="modal-dialog" style="width: 80%">
                  <div class="modal-content">
                         <div class="modal-header modal-header-primary">
                            <h1>Datos del activo</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="block">
                                <label>Nº de placa:</label><br>
                                    <?php echo '<input type="text" class="form-control col-sm-3" readonly="readonly" name="fecha" value="' . htmlspecialchars($technicalReport->asset->plaque) . '">'; ?>     
                            </div><br>

                            <div>
                                <label>Nº de serie:</label><br>
                                    <?php echo '<input type="text" class="form-control col-sm-3" readonly="readonly" name="fecha" value="' . htmlspecialchars($technicalReport->asset->series) . '">'; ?>     
                            </div><br>

                            <div>
                                <label>Marca:</label><br>
                                    <?php echo '<input type="text" class="form-control col-sm-3" readonly="readonly" name="fecha" value="' . htmlspecialchars($technicalReport->asset->brand) . '">'; ?>     
                            </div><br>

                            <div>
                                <label>Modelo:</label><br>
                                    <?php echo '<input type="text" class="form-control col-sm-3" readonly="readonly" name="fecha" value="' . htmlspecialchars($technicalReport->asset->model) . '">'; ?>     
                            </div><br>

                            <div>
                            <label>Descripción:</label><br>
                                <textarea class="form-control" readonly="readonly" rows="3" cols="20"><?= h($technicalReport->asset->description);?></textarea>     
                            </div><br>
            
                         </div>
                    </div>
                </div>
            </div>



            
            <div>
                <label>Evaluación:</label><br>
                <textarea class="form-control" readonly="readonly" rows="3" cols="20"><?= h($technicalReport->evaluation);?></textarea>     
            </div>
            <br>

            <div>
                <label>Recomendación:</label><br>
                <?php if ("U"==$technicalReport->recommendation): ?>
                    Reubicar
                <?php endif; ?>

                <?php if("P"==$technicalReport->recommendation): ?>
                    Reparar
                <?php endif; ?>

                <?php if("E"==$technicalReport->recommendation): ?>
                    Desechar
                <?php endif; ?>

                <?php if("D"==$technicalReport->recommendation): ?>
                    Usar piesas
                <?php endif; ?>

                <?php if("O"==$technicalReport->recommendation): ?>
                    Otros
                <?php endif; ?>
            </div>
            <br><br>

        

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

    <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $technicalReport->technical_report_id], ['class' => 'btn btn-primary']) ?>
    
    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $technicalReport->technical_report_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea eliminar la Ubicación # {0}?', $technicalReport->technical_report_id)]) ?>

    <?= $this->Form->postLink(__('Generar Pdf'), ['action' => 'download', $technicalReport->technical_report_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea descargar el archivo?', $technicalReport->technical_report_id)]) ?>
</div>
