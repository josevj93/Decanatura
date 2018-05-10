<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>

<div class="technicalReports form large-9 medium-8 columns content">
    <?= 
    //$this->Form->create($technicalReport) 

      echo $this->Form->create($technicalReport, ['url' => ['TechnicalReport' => 'Articles', 'action' => 'download']);
    ?>
    
    <fieldset>
        <h3><legend><?= __('Editar Informe Técnico') ?></legend></h3>
        <?php
            echo "<b>Fecha:<br /></b>";
            echo $this->Form->control('date',array('label' => false));
            echo "<b><br />Activos:<br /></b>";
            echo $this->Form->control('assets_id', array('label' => false), ['options' => $assets] );
            echo "<b><br />Evaluación:<br /></b>";
            echo $this->Form->textarea('evaluation', array('label' => false));
            echo "<b><br /><br />Recomendación:<br /></b>";
            echo $this->Form->control('recommendation', array('label' => false));
        ?>
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

    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>



    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>

</div>

