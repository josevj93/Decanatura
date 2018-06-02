

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
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

        .btn-primary{
  margin: 10px;
    margin-top: 15px;
}
        
  </style>

</head>

<body>

<div class="col-md-12 col-sm-12">
    <h3>Insertar préstamo</h3>
    <?= $this->Form->create($loan, ['type' => 'file']) ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_assets', array('options' => $assets,'label'=>'Placa', 'class' => 'form-control')); ?>
</div>

<br>
    
<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <?php echo $this->Form->control('id_responsables', array('options' => $users,'label'=>'Responsable', 'class' => 'form-control')); ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <label>Fecha inicio:</label>
        <?php
        echo $this->Form->imput('fecha_inicio', ['class'=>'form-control ','id'=>'datepicker']); 
        ?>
</div>

<br>

<div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
    <label>Fecha de devolución:</label>
        <?php
        echo $this->Form->imput('fecha_devolucion', ['class'=>'form-control ','id'=>'datepicker2']); 
        ?>
</div>

<br>

<div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
    <?php echo $this->Form->control('observaciones', array('label'=>'Observaciones', 'class' => 'form-control', 'rows' => '3')); ?>
</div>

<br>

<div class="col-12 text-right">

    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    <?= $this->Html->link(__('Cancelar'), ['controller' => 'Loans', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>
    
</div>

</body>

<script>
  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-y' });
    $( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-y' });
  } );  
</script>
