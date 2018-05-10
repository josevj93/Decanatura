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

  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );

  </script>

  <style>
        .btn-primary {
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
  </style>

</head>


<body>


  <br>
<div class="locations form large-9 medium-8 columns content">
  <?= $this->Form->create($technicalReport) ?>
  <fieldset>
    <legend><?= __('Insertar informe técnico') ?></legend>
  
    <div class="row">
      

      <div class="col-md-6">
        <label>Nº Reporte:</label><br>
        <?php 
          echo h('Numero autogenerado');
          ?>
      </div>

      <div class="col-md-6">
        <label>Fecha:</label><br>
        <?php
        echo $this->Form->imput('date', ['class'=>'form-control col-sm-6','id'=>'datepicker']); 
        ?>
      
      </div>

    </div><br>

    

     /** TRABAJANDO EN ESTA PARTE **/
    <br>
    | barrar de busqueda | boton
     <br> 
    /** TRABAjANDO EN ESTA PARTE **/
  
    <br><br>
    <?php echo $this->Form->control('assets_id', ['options' => $assets]); ?>
    <br>

    <div>
      <label for="Evaluacion">Evaluación:</label>
      <?php 
        echo $this->Form->textarea('evaluation', ['label' => 'Evaluación:', 'class'=>'form-control col-md-6']);
      ?>
    </div>
    <br>

    <div>
      <label for="Evaluacion">Recomendación:</label>
      <br>
      <?php
       echo $this->Form->radio('recommendation',
          [
           ['value'=>'C', 'text'=>'Reubicar  '],
           ['value'=>'R', 'text'=>'Reparar  '],
           ['value'=>'D', 'text'=>'Desechar  '],
           ['value'=>'U', 'text'=>'Usar piesas  '],
           ['value'=>'O', 'text'=>'Otros'],
          ]);
      ?>
    </div> 
    <br>

    <div>
    <?php echo $this->Form->file('document'); ?>
    </div>
    <br>

  </fieldset>


</div>
  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

</body>
