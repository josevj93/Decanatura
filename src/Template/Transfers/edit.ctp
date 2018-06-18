<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */

use Cake\Routing\Router;
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js" type="text/javascript"></script>

<style>
    .btn-primary[type=submit]{
        color: #fff;
        background-color: #0099FF;
        border-color: #0099FF;
        float: right;
        margin-left: 10px;
    }
    .btn-primary {
        color: #fff;
        background-color: #0099FF;
        border-color: #0099FF;
        float: right;
        margin-left: 10px;
        }
       
</style>


<nav class="large-3 medium-4 columns" id="actions-sidebar">

</nav>
<div class="transfers form large-9 medium-8 columns content">
    <?= $this->Form->create($transfer) ?>
    <legend>Traslado</legend>
    <br>
        <div class= 'row'>
            <div class ="col-md-8">                
                <label>Nº traslado:</label>
                <?php echo '<input type="text" class="form-control col-sm-4" readonly="readonly" value="' . htmlspecialchars($transfer->transfers_id). '">'; ?> 
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
        <!-- Tabla para rellenar los datos de las unidades académicas -->
        <tr>
            <th class="transfer-h"><h5>Unidad que entrega<h5></th>
            <th class="transfer-h"><h5>Unidad que recibe<h5></th>
        </tr>
        <tr>
            <!-- Fila para la Unidad que entrega -->
            <td>
                <div class="row" >
                    <label class="label-t">Unidad académica: </label>
                   
                    <?php echo '<input type="text" class="form-control col-sm-6"  value="' . htmlspecialchars($Unidad) . '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php echo '<input type="text" name="functionary" class="form-control col-sm-6"  value="' . htmlspecialchars($transfer->functionary) . '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php echo '<input type="text" name="identification" class="form-control col-sm-4"  value="' . htmlspecialchars($transfer->identification) . '">'; ?>
                </div>
            </td>


            <!-- Fila para la Unidad que recibe -->
            <td>
                <div class="row">
                    
                        <label class="label-t">Unidad académica: </label>
                    
                        <?php echo '<input type="text" name="Acade_Unit_recib" class="form-control col-sm-6"  value="' . htmlspecialchars($transfer->Acade_Unit_recib). '">'; ?>
                    
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php echo '<input type="text" name="functionary_recib" class="form-control col-sm-6"  value="' . htmlspecialchars($transfer->functionary_recib). '">'; ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php echo '<input type="text" name="identification_recib" class="form-control col-sm-4"  value="' . htmlspecialchars($transfer->identification_recib) . '">'; ?>
                </div>               
            </td>
            
        </tr>
    </table>
    <br>


    <!-- AQUI ESTA LO IMPORTANTE. RECUERDEN COPIAR LOS SCRIPTS -->
    <div class="related">
        <legend><?= __('Activos a trasladar') ?></legend>


        <!-- tabla que contiene  datos básicos de activos-->
        <table id='assets-transfers-grid' cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="transfer-h"><?= __('Placa') ?></th>
                    <th class="transfer-h"><?= __('Marca') ?></th>
                    <th class="transfer-h"><?= __('Modelo') ?></th>
                    <th class="transfer-h"><?= __('Serie') ?></th>
                    <th class="transfer-h"><?= __('Estado') ?></th>
                    <th class="transfer-h"><?= __('Seleccionados') ?></th>
                </tr>
            <thead>
            <tbody> 
                
                <tr>
                    <td><?= h($a->plaque) ?></td>
                    <td><?= h($a->brand) ?></td>
                    <td><?= h($a->model) ?></td>
                    <td><?= h($a->series) ?></td>
                    <td><?= h($a->state) ?></td>
                    <td><?php
                        // If que verifica si el checkbox debe ir activado o no

                        $isIn= in_array($a->plaque, array_column($result, 'plaque') );
                        if($isIn)
                            {
                                echo $this->Form->checkbox('assets_id',
                                ['value'=>htmlspecialchars($a->plaque),'checked', "class"=>"chk" ]
                                );

                            }
                        else
                            {
                                echo $this->Form->checkbox('assets_id',
                                ['value'=>htmlspecialchars($a->plaque),"class"=>"chk"]
                                );
                            }

                        ?>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- input donde coloco la lista de placas checkeadas -->
    <input type="hidden" name="checkList" id="checkList">
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary','id'=>'acept']) ?>
    <?= $this->Form->end() ?>


</div>



<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#assets-transfers-grid').DataTable( {
              dom: "iDisplayLength": 10,
                   "paging": true,
                   "pageLength": 10,
                    "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "decimal": ",",
                    "thousands": ".",
                    "sSelect": "1 fila seleccionada",
                    "select": {
                        rows: {
                            _: "Ha seleccionado %d filas",
                            0: "Dele click a una fila para seleccionarla",
                            1: "1 fila seleccionada"
                        }
                    },
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
        } );
    } );

    $("document").ready(
    function() {
      $('#acept').click( function()
      {
        var check = getValueUsingClass();
        $('#checkList').val(check);

        });
        }
    );

/** función optenida de http://bytutorial.com/blogs/jquery/jquery-get-selected-checkboxes */

    function getValueUsingClass(){
    /* declare an checkbox array */
    var chkArray = [];
    
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
    });
    
    /* we join the array separated by the comma */
    var selected;
    selected = chkArray.join(',') ;
    return selected;
}
</script>

