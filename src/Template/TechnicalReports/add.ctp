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
          color: #000;
          background-color: #7DC7EF;
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;
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
      

      <div class="col-md-6">
        <div class='input-group mb-3'>
          <label>Nº Reporte:  número autogenerado</label><br>
        </div>
      </div>

      <div class="col-md-6">
        <div class='row'>
        <label>Fecha:  </label>
        <?php
        echo $this->Form->imput('date', ['class'=>'form-control col-sm-6','id'=>'datepicker']); 
        ?>
        </div>
      </div>

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

<script>

  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );

  $("document").ready(
    function() {

      $('#assetButton').click( function()
      {
        var plaque = $('#assetImput').val();
        var prueba = '640';
        if(''!=plaque)
        {
         $.ajax({
                type: "GET",
                url: '<?php echo Router::url(['controller' => 'TechnicalReports', 'action' => 'seach' ]); ?>',
                data:{id:'640'},
                beforeSend: function() {
                     $('#assetResult').html('Cargando...');
                     },
                success: function(msg){
                    $('#assetResult').html(msg);
                }
              });
          //$('#assetResult').html('FRITO...');
        }
        else
        {
          $('#assetResult').html('Primero escriba un número de placa.');
        }

      });

    }
  );

</script>