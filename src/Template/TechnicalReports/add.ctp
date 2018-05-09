<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
