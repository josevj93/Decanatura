<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
   use Cake\Routing\Router;
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <?php echo $this->Html->css('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');?>
  <link rel="stylesheet" href="/resources/demos/style.css">

  <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
  <style>
        .btn-primary {
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
        
        .btn-default {
          color: #000;
          background-color: #7DC7EF;
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;
        }
        label {
          text-align:left;
          margin-right: 10px;
          
        }
        input[type=radio] {
          width:10px;
          clear:left;
          text-align:left;
        }
        input[name=date]{
          width:100px;
          margin-left: 10px;
        }

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

</head>


<body>
<div class="locations form large-9 medium-8 columns content">
  <?= $this->Form->create($transfer)?>
  <fieldset>
    <legend><?= __('Insertar acta de traslado') ?></legend>
    <br>
    <div class="row">
      <div class="col-md-8">
        <div >
          <label>Nº Formulario:</label>
          <label><?php echo h($tmpId); ?> *</label>
        </div>
      </div>
      <label>Fecha:</label>
        <?php
        echo $this->Form->imput('date', ['class'=>'form-control ','id'=>'datepicker','value' => 
            date("y-m-d")]); 
        ?>
  </div>
    <div id=assetResult> 
    </div><br>
    <div>
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
                   
                    <label>Ingeniería</label>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php 
            echo $this->Form->imput('functionary', ['label' => 'functionary:', 'class'=>'form-control col-sm-4']);
            ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php 
            echo $this->Form->imput('identification', ['label' => 'identification:', 'class'=>'form-control col-sm-4']);
            ?>
                </div>
            </td>
            <!-- Fila para la Unidad que recibe -->
            <td>
                <div class="row">
                        <label class="label-t">Unidad academica: </label>
                        <?php 
            echo $this->Form->imput('Acade_Unit_recib', ['label' => 'Acade_Unit_recib:', 'class'=>'form-control col-sm-4']);
            ?>       
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Funcionario: </label>
                    <?php 
            echo $this->Form->imput('functionary_recib', ['label' => 'functionary:', 'class'=>'form-control col-sm-4']);
            ?>
                </div>
                <br>
                <div class="row">
                    <label class="label-t">Identificación:</label>
                    <?php 
            echo $this->Form->imput('identification_recib', ['label' => 'identification_recib:', 'class'=>'form-control col-sm-4']);
            ?>
                </div>               
            </td>
        </tr>
    </table>

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
                <?php 
                foreach ($asset as $a): ?>
                <tr>
                    <td><?= h($a->plaque) ?></td>
                    <td><?= h($a->brand) ?></td>
                    <td><?= h($a->model) ?></td>
                    <td><?= h($a->series) ?></td>
                    <td><?= h($a->state) ?></td>
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
        <input type="hidden" name="checkList" id="checkList">

    </div>
    <br>
    <br>
    <div>
    <label>nota * : El número de formulario es autogenerado.</label>

    </div>
    <br>
  </fieldset>
</div>

  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary','id'=>'acept']) ?>
</body>

<script>
  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );
  $("document").ready(
    function() {
      $('#assetButton').click( function()
      {
        var plaque = $('#assetImput').val();
        if(''!=plaque)
        {
         $.ajax({
                type: "GET",
                url: '<?php echo Router::url(['controller' => 'TechnicalReports', 'action' => 'search' ]); ?>',
                data:{id:plaque},
                beforeSend: function() {
                     $('#assetResult').html('<label>Cargando</label><i class="fa fa-spinner fa-spin" style="font-size:25px"></i>');
                     },
                success: function(msg){
                    $('#assetResult').html(msg);
                    },
                error: function(e) {
                    alert("Ocurrió un error: artículo no encontrado.");
                    console.log(e);
                    $('#assetResult').html('Introdusca otro número de placa.');
                    }
              });
          
        }
        else
        {
          $('#assetResult').html('Primero escriba un número de placa.');
        }
      });
    }
  );
</script>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#assets-transfers-grid').DataTable( {} );
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

