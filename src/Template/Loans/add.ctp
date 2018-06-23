<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
    use Cake\Routing\Router;
?>

<style>
        .btn-primary {
            margin: 10px;
            margin-top: 15px;
        }

        label {
          text-align:left;
          margin-right: 10px;
          
        }

        .sameLine{
          display: flex; 
          justify-content: space-between; 
          border-color: transparent;
        }

        </style> 

<div class="locations form large-9 medium-8 columns content">
    <legend><?= __('Insertar préstamo') ?></legend>
    
    <br>

    <?= $this->Form->create($loan) ?>

    <div class="form-control sameLine" >

        <div class="row">
            <label> <b>Responsable:</b><b style="color:red;">*</b> </label>
        <?php echo $this->Form->select('id_responsables', $users, array('empty' => true, 'class' => 'form-control col-md-7')); ?>        
        </div>





        <div class="row col-md-4">
             <label> <b>Fecha inicio:</b><b style="color:red;">*</b> </label>
                <?php
                    echo $this->Form->imput('fecha_inicio', ['class'=>'form-control date col-md-7', 'value' => date("y-m-d")]); 
                ?>
        </div>

    </div> <br>



   
 <!-- AQUI ESTA LO IMPORTANTE. RECUERDEN COPIAR LOS SCRIPTS -->
        <div class="related">
            <legend><?= __('Asignacion de activos a prestamo') ?></legend>

            <!-- tabla que contiene  datos básicos de activos-->
            <table id='assets-transfers-grid' cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th class="transfer-h"><?= __('Placa') ?></th>
                        <th class="transfer-h"><?= __('Marca') ?></th>
                        <th class="transfer-h"><?= __('Modelo') ?></th>
                        <th class="transfer-h"><?= __('Serie') ?></th>
                        <th class="transfer-h"><?= __('Seleccionados') ?></th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                      foreach ($result as $a): ?>
                      <tr>
                          <td><?= h($a->plaque) ?></td>
                          <td><?= h($a->brand) ?></td>
                          <td><?= h($a->model) ?></td>  
                          <td><?= h($a->series) ?></td>
                          <td><?php
                        
                                      echo $this->Form->checkbox('assets_id',
                                      ['value'=>htmlspecialchars($a->plaque),"class"=>"chk"]
                                      );
                                  
                              ?>
                              
                          </td>
                      </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>

        </div>

    <!-- input donde coloco la lista de placas checkeadas -->
    <input type="hidden" name="checkList" id="checkList">



    <div class="row col-md-6">
            <label><b>Fecha de devolución:</b><b style="color:red;">*</b> </label>
                <?php
                echo $this->Form->imput('fecha_devolucion', ['class'=>'form-control date col-md-4']); 
                ?>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <?php echo $this->Form->control('observaciones', array('label'=>'Observaciones:', 'class' => 'form-control', 'rows' => '3')); ?>
        </div>
    </div>

    <br>

    <div class="col-12 text-right">

       
        <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary', 'id' => 'acept']) ?>
        <?= $this->Html->link(__('Cancelar'), ['controller' => 'Assets', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
        

    </div>
    
    <?= $this->Form->end(); ?>

</div>

<script>
    /*prueba para autocompletar*/
    /*
    jQuery('#assetImput').autocomplete({
            source:'<?php echo Router::url(array('controller' => 'Loan', 'action' => 'getPlaques')); ?>',
            minLength: 2
        });
    */

    $(document).ready(function() 
    {
       var table = $('#assets-transfers-grid').DataTable( {
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
