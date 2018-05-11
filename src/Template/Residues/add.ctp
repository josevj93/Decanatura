<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue $residue
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
  <?= $this->Form->create($residue) ?>
  <fieldset>
    <legend><?= __('Insertar informe técnico') ?></legend>
    <br>
    <div class="row">
      

      <div class="col-md-6">
        <div class='row'>
          <label>Nº autorización:</label>
            <?php
            echo $this->Form->imput('residues_id', ['class'=>'form-control col-sm-6']); 
            ?>
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

    </div><br>

    <label>En presencia de</label><br>
    <div >
        
            <div class="row">
                <div class="row">
                    <label>Nombre:</label>
                    <?php
                    echo $this->Form->imput('name1', ['class'=>'form-control col-sm-6']); 
                    ?>
                </div>
                <div class="row">
                    <label>Cédula:</label>
                    <?php
                    echo $this->Form->imput('identification1', ['class'=>'form-control col-sm-6']); 
                    ?>
                </div>
            </div><br>
            <div class="row">
                <div class="row">
                    <label>Nombre:</label>
                    <?php
                    echo $this->Form->imput('name2', ['class'=>'form-control col-sm-6']); 
                    ?>
                </div>
                <div class="row">
                    <label>Cédula:</label>
                    <?php
                    echo $this->Form->imput('identification2', ['class'=>'form-control col-sm-6']); 
                    ?>
                </div>
            </div>
              
    </div><br><br>

    /********************************/<br>
            PARTE DE RUBEN<br>

        [lista de activos para ser desechados]<br>

    /********************************/<br>
    

  </fieldset>


</div>
  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

</body>

<script>

  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );


</script>
