<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue $residue
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
          color: #FFF;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }
    </style> 

</head>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Residues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Insertar acta de desecho') ?></legend>
            <div>
                <label>Numero</label><br>
                <?php 
                echo $this->Form->imput('residues_id', ['label' => 'Numero', 'class'=>'form-control col-sm-2']);
                ?><br>
            </div>
            <div>
                <label>Fecha:</label><br>
                <?php 
                    echo $this->Form->control('date', ['empty' => true]);
                ?><br>
            </div>
        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label>Nombre:  </label>
                <?php 
                    echo $this->Form->imput('name1', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Cédula:  </label>
                <?php 
                    echo $this->Form->imput('identification1', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class='input-group mb-3'>
              <label >Nombre:</label>
                <?php 
                    echo $this->Form->imput('name2', ['class'=>'form-control col-sm-6']);
                ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class='row'>
            <label>Cédula:  </label>
                <?php 
                    echo $this->Form->imput('identification2', ['class'=>'form-control col-sm-6']);
                ?> 
            </div>
          </div>
        </div>
    </fieldset>
</div>

        <label>Placa del activo:</label><br>
        <div class='input-group mb-3'>
            
              <?php 
                echo $this->form->imput('assets_id',['class'=>'form-control col-sm-3', 'id'=>'assetImput', 'name' => 'Aid'])
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
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
</div>

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
                url: '<?php echo Router::url(['controller' => 'Residues', 'action' => 'search' ]); ?>',
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

