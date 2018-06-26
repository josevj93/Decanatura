<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
?>
<style>
    table {

    border-collapse: collapse;
    width: 100%;
    }
    td{
        border: 1px solid #000000;
        border-bottom: 1px solid #000000;
        padding: 8px;
    }
    th[class=transfer-h]{
        border-bottom: 1px solid #000000;
        text-align: center;
        color:black;
        padding: 8px;
    }
    label[class=label-t]{
        margin-left: 20px;
    }
    label {
        text-align:left;
        margin-right: 10px;
          
    }
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left:10px;
    }

</style>
<div class="transfers view large-9 medium-8 columns content">
    <legend>Traslado</legend>
    <br>
        <div class= 'row'>
            <div class ="col-md-8">                
                    <label>Nº traslado:</label>
                    <?php //echo '<input type="text" class="form-control col-sm-2" readonly="readonly" value="' . htmlspecialchars($transfer->transfers_id). '">'; ?> 
            </div>

            <label>Fecha:</label>
            <?php
            // para dar formato a la fecha
            $tmpDate= $transfer->date->format('d-m-Y');
            ?>  
            <?php echo '<input type="text" class="form-control col-sm-2" readonly="readonly" value="' . htmlspecialchars($tmpDate) . '">'; ?> 
        </div>
    <br>
    <table>
        <!-- Tabla para rellenar los datos de las unidades academicas -->
        <tr>
            <th class="transfer-h"><h5>Unidad que entrega<h5></th>
            <th class="transfer-h"><h5>Unidad que recibe<h5></th>
        </tr>
        <tr>
            <!-- Fila para la Unidad que entrega -->
            <td>
                <div class="row" >
                    <label class="label-t">Unidad academica: </label>
                   
                    <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" value="' . htmlspecialchars($Unidad) . '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" value="' . htmlspecialchars($transfer->functionary) . '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php echo '<input type="text" class="form-control col-sm-4" readonly="readonly" value="' . htmlspecialchars($transfer->identification) . '">'; ?>
                </div>
            </td>


            <!-- Fila para la Unidad que recibe -->
            <td>
                <div class="row">
                    
                        <label class="label-t">Unidad academica: </label>
                    
                        <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" value="' . htmlspecialchars($transfer->Acade_Unit_recib). '">'; ?>
                    
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" value="' . htmlspecialchars($transfer->functionary_recib). '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php echo '<input type="text" class="form-control col-sm-4" readonly="readonly" value="' . htmlspecialchars($transfer->identification_recib) . '">'; ?>
                </div>               
            </td>
            
        </tr>
    </table>
    <br>
    
    <div class="related">
        <legend><?= __('Activos trasladados') ?></legend>

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th class="transfer-h" scope="col"><?= __('Placa') ?></th>

                <th class="transfer-h" scope="col"><?= __('Marca') ?></th>
                <th class="transfer-h" scope="col"><?= __('Modelo') ?></th>
                <th class="transfer-h" scope="col"><?= __('Serie') ?></th>
                <th class="transfer-h" scope="col"><?= __('Estado') ?></th>
                
            </tr>
            <?php //debug ($result) ?>

            <?php foreach ($result as $asset): ?>
            <tr>
                <?php
                    //$a= (object)$asset->assets;
                ?>
                <td><?= h($asset->plaque) ?></td>
                <td><?= h($asset->brand) ?></td>
                <td><?= h($asset->model) ?></td>
                <td><?= h($asset->series) ?></td>
                <td><?= h($asset->state) ?></td>

            </tr>
            <?php endforeach; ?>
        </table>

    </div>

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

    <?= $this->Html->link(__('Modificar'), ['action' => 'edit', $transfer->transfers_id], ['class' => 'btn btn-primary']) ?>
    

    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $transfer->transfers_id], ['class' => 'btn btn-primary', 'confirm' => __('¿Seguro que desea eliminar la Ubicación #'.$transfer->transfers_id.' ?', $transfer->transfers_id)]) ?>

</div>
