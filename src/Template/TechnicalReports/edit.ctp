<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <?php echo $this->Html->css('//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');?>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="technicalReports form large-9 medium-8 columns content">
    <?= $this->Form->create($technicalReport) ?>
    <h3>Editar Informe Técnico</h3>
    <fieldset>
        <div class="form-group">
        <?php

            // ID que se despliega pero no es editable
            echo $this->Form->input('technical_report_id',array('type' => 'text','label'=>'Reporte #:', 'disabled' => true, 'class' => 'form-control'));

            // La fecha de creación del reporte con date picker
            echo "<b>Fecha:<br /></b>";
            echo $this->Form->imput('date', array('class' =>'form-control col-sm-12', 'id'=>'datepicker')); 

            // Activos relacionados al formulario que estamos llenando
            echo "<b>Activos:<br /></b>";
            echo $this->Form->control('assets_id', array('label' => false, 'options' => $assets,'class' => 'form-control'));

            //Evaluación actual del activo
            echo $this->Form->control('evaluation', array('label'=>'Evaluación', 'class' => 'form-control'));

            //Recomendación Actual
            echo "<b>Recomendación:<br /></b>";
            echo $this->Form->radio('recommendation',
            [
            ['value'=>'C', 'text'=>'Reubicar  '],
            ['value'=>'R', 'text'=>'Reparar  '],
            ['value'=>'D', 'text'=>'Desechar  '],
            ['value'=>'U', 'text'=>'Usar piesas  '],
            ['value'=>'O', 'text'=>'Otros'],
            ]
            );
            
            echo "<b><br />Reporte firmado:<br /></b>";
            echo $this->Form->input('document', ['type' => 'file', 'class' => 'form-control', 'label' => false]); 
            ?>
        
        </div>

    </fieldset>

<style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left: 10px;
    }
</style> 
</div>

    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>

    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>


<script>

  $( function Picker() {
    $( "#datepicker" ).datepicker({ dateFormat: 'y-mm-dd' });
  } );

</script>