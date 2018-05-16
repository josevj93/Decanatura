<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
<<<<<<< HEAD
=======
   use Cake\Routing\Router;
>>>>>>> origin/Develop
?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function Fecha() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>

<?php

    $placa="Hola";
    if($_GET['btnBuscar']){Buscar();}

    function Buscar() {
      $placa= $_GET['lblPlaca'] ; 
    }


?>

<body>


<legend><?= __('Insertar informe técnico') ?></legend>
  <br>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    <label for="nRepote">Numero de reporte:</label>
     <div class="col-md-4 col-sm-4">
          <input type="text" class="form-control" id="">
     </div>
    <br>

   <label for="Fecha">Fecha:</label>
    <div class="col-md-4 col-sm-4">
       <input class="form-control" input-group pull-right type="text" name="date" id="datepicker" onclick="Fecha()">    
   </div>
    <br>


   
    <label for="Fecha">Placa del activo: </label>
    <div class="col-xs-6 col-md-6">
      <div class="input-group">
          <input type="text" class="form-control col-sm-4" placeholder="Buscar" name="textoBusqueda"
          onclick="" />
          </div>
      </div>
    </div>

    <br>
    Lalala
    <div class="col-lg-6">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Numero de plcada" name="lblPlaca" > 
        <span class="input-group-btn">
          <button id="btnBuscar" name="btnBuscar" onClick='location.href="?btnBuscar=1"'><i class="fa fa-search"></i></button>
        </span>
      </div>
    </div>

    <?php if ($placa == "Hola"): ?>
        <?= h($placa) ?>
    <?php endif; ?>
  
    <?php echo $this->Form->control('assets_id', ['options' => $assets]); ?>
    <label for="Evaluacion">Evaluación:</label>
     <div class="col-md-8 col-sm-6">  
       <textarea class="form-control" type="text" name="evaluation" rows="5" cols="40"></textarea></p>
     </div> 
   <br>

   <label for="Recomendacion">Recomendación:</label>
    <div class="col-md-8 col-sm-6">
       <input type="radio" name="recommendation" value="U">Reubicar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <input type="radio" name="recommendation" value="P">Reparar  &nbsp;
       <input type="radio" name="recommendation" value="E">Desechar
       <br>
       <input type="radio" name="recommendation" value="D">Usar piesas &nbsp;
       <input type="radio" name="recommendation" value="O">Otros  
    </div>
    <br>

    <input type="submit" name="submit" value="Submit">  
  </form>


</body>
=======
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
        
  </style>

</head>


<body>
<div class="locations form large-9 medium-8 columns content">
  <?= $this->Form->create($technicalReport) ?>
  <fieldset>
    <legend><?= __('Insertar informe técnico') ?></legend>
    <br>
    
    <div class="row">

      <div class="col-md-8">
        <div >
          <label>Nº Reporte:</label>
          <label><?php echo h($tmpId); ?> *</label>

        </div>
      </div>

      <label>Fecha:</label>
        <?php
        echo $this->Form->imput('date', ['class'=>'form-control ','id'=>'datepicker']); 
        ?>
  </div>
    

    <label>Placa del activo:</label><br>
    <div class='input-group mb-3'>
        
          <?php 
            echo $this->form->imput('assets_id',['class'=>'form-control col-sm-3', 'id'=>'assetImput'])
          ?>
          <div class= 'input-group-append'>
          <?php echo $this->Html->link('Buscar','#',['type'=>'button','class'=>'btn btn-default','id'=>'assetButton','onclick'=>'return false']);
          ?>
          </div>
          <br>
          

    </div>
    <div id=assetResult> 
    </div><br>
   
    

    <div>
      <label for="Evaluacion">Evaluación:</label>
      <?php 
        echo $this->Form->textarea('evaluation', ['label' => 'Evaluación:', 'class'=>'form-control col-md-8']);
      ?>
    </div>
    <br>

    <div>
      <label >Recomendación:</label>
      <br>
      <?php
       echo $this->Form->radio('recommendation',
          [
           ['value'=>'C', 'text'=>'Reubicar  '],
           ['value'=>'R', 'text'=>'Reparar  '],
           ['value'=>'D', 'text'=>'Desechar  '],
           ['value'=>'U', 'text'=>'Usar piesas  '],
           ['value'=>'O', 'text'=>'Otros'],
          ]);
      ?>
    </div> 
    <br>

    <div>
    <label>nota * : El número de reporte es autogenerado.</label>
    </div>
    <br>

  </fieldset>


</div>
  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->postLink(__('Generar Pdf'), ['action' => 'download', $technicalReport->technical_report_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea descargar el archivo?', $technicalReport->technical_report_id)]) ?>


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
>>>>>>> origin/Develop
