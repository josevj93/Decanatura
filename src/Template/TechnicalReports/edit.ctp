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
        
        input[name=plaque]{
          margin-left: 10px;
        }
        input[name=brand]{
          margin-left: 19px;
        }
        input[name=series]{
          margin-left: 13px;
        }
        input[name=model]{
         margin-left: 10px;
        }

        .sameLine{
          display: flex; 
          justify-content: space-between; 
          border-color: transparent;
        }
  </style>

</head>


<body>

<div class="locations form large-9 medium-8 columns content">
  <?= $this->Form->create($technicalReport) ?>
  <fieldset>
    <legend><?= __('Editar informe técnico') ?></legend>
    <br>
    
    <div class="form-control sameLine">

      <div class="row">
          <label>Nº Reporte:</label>
          <label><?php echo h($technicalReport->technical_report_id); ?> </label>
      </div>

      <div class="row">
        <label>Fecha:</label>
        <?php
        $tmpDate= $technicalReport->date->format('Y-m-d');
        echo $this->Form->imput('date', ['class'=>'form-control ','id'=>'datepicker','value'=>$tmpDate]); 
        ?>
      </div>
  </div>
    

    <label required="required"><b>Placa del activo:</b><font color="red"> * </font></label>
    <div class='input-group mb-3'>
        
          <?php 
            echo $this->form->imput('assets_id',['class'=>'form-control col-sm-3', 'id'=>'assetImput','value'=>$technicalReport->assets_id])
          ?>
          <div class= 'input-group-append'>
          <?php echo $this->Html->link('Buscar','#',['type'=>'button','class'=>'btn btn-default','id'=>'assetButton','onclick'=>'return false']);
          ?>
          </div>
          <br>
          

    </div>
    <div id=assetResult>
        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label>Nº placa:</label>
              <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" name="plaque" value="' . htmlspecialchars($assets2->plaque) . '">'; ?> 
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Marca:  </label>
            <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" name="brand" value="' . htmlspecialchars($assets2->brand). '">'; ?> 
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label >Nº serie:</label>
              <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" name="series" value="' . htmlspecialchars($assets2->series) . '">'; ?> 
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Modelo:  </label>
            <?php echo '<input type="text" class="form-control col-sm-6" readonly="readonly" name="model" name="fecha" value="' . htmlspecialchars($assets2->model). '">'; ?> 
            </div>
          </div>
        </div>

        <div>
          <label>Descripción:</label><br>
            <textarea class="form-control col-md-8" readonly="readonly" rows="3" cols="10"><?= h($assets2->description);?></textarea>     
        </div>

    </div><br>
   
    

    <div>
      <label required="required"><b>Evaluación:</b><font color="red"> * </font></label>
      <?php 
        echo $this->Form->textarea('evaluation', ['label' => 'Evaluación:', 'class'=>'form-control col-md-8']);
      ?>
    </div>
    <br>

    <div>
      <label required="required"><b>Recomendación:</b><font color="red"> * </font></label>
      <br>
      <?php
       echo $this->Form->radio('recommendation',
          [
           ['value'=>'C', 'text'=>'Reubicar  '],
           ['value'=>'R', 'text'=>'Reparar  '],
           ['value'=>'D', 'text'=>'Desechar  '],
           ['value'=>'U', 'text'=>'Usar piezas  '],
           ['value'=>'O', 'text'=>'Otros'],
          ]);
      ?>
    </div> 
    <br>
    <div class="row col-md-8">
          <label>Nombre del Técnico Especializado:</label>
            <?php
              echo $this->Form->imput('evaluator_name', ['class'=>'form-control col-md-5 ']); 
            ?>
      
    </div>

  </fieldset>


</div>
  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->postLink(__('Generar Pdf'), ['action' => 'download', $technicalReport->technical_report_id], ['class' => 'btn btn-primary', 'confirm' => __('Seguro que desea descargar el archivo?', $technicalReport->technical_report_id)]) ?>


</body>

<script>
  $( function Picker() {
    $( "#datepicker" ).datepicker({ 
          dateFormat: 'y-mm-dd',
          monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
          dayNamesMin: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'] });
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