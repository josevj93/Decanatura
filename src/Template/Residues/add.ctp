<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue $residue
 */
    use Cake\Routing\Router;

    $mysqli = new mysqli('decanatura.mysql.database.azure.com','ecci@decanatura','Gaby1234','decanatura');
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

<?php
/*
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Residues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
*/
?>

<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Insertar acta de desecho') ?></legend>
           
      <div class="row">

        <div class="col-md-6">
            <div>
                <label>Número de Reporte</label><br>
                <?php 
                echo $this->Form->imput('residues_id', ['label' => 'Numero', 'class'=>'form-control col-sm-6']);
                ?><br>
            </div>
        </div>    
            
            <div>
                <label>Fecha:</label><br>
                <?php 
                    echo $this->Form->imput('date', ['class'=>'form-control ','id'=>'datepicker']);
                    //echo $this->Form->control('date', ['empty' => true]);
                ?><br>
            </div>
      
      </div>

        <div class="row">

          <div class="col-md-6">

              <label>Nombre:</label>
                <?php 
                    echo $this->Form->imput('name1', ['class'=>'form-control col-sm-6']);
                ?>
          </div>
              
          <div class="col-md-6">
            
            <label>Cédula:</label>
                <?php 
                    echo $this->Form->imput('identification1', ['class'=>'form-control col-sm-6']);
                ?>
          </div>
           
      </div>

        <div class="row">

          <div class="col-md-6">

            
              <label >Nombre:</label>
                <?php 
                    echo $this->Form->imput('name2', ['class'=>'form-control col-sm-6']);
                ?>
            
          </div>

          <div class="col-md-6">
            
            <label>Cédula:  </label>
                <?php 
                    echo $this->Form->imput('identification2', ['class'=>'form-control col-sm-6']);
                ?> 
          </div>

        </div>
    </fieldset>
</div>
<br>
<br>
        <!-- AQUI ESTA LO IMPORTANTE. RECUERDEN COPIAR LOS SCRIPTS -->
        <div class="related">
            <legend><?= __('Activos a desechar') ?></legend>

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
                      foreach ($result as $a): ?>
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

    <!-- input donde coloco la lista de placas checkeadas -->
    <input type="hidden" name="checkList" id="checkList">

<br>
<br>
<div>
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary', 'id'=>'acept']) ?>
</div>

<script type="text/javascript">

 $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );

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
