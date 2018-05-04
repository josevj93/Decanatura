<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Technical Reports'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
    </ul>
</nav>


<legend><?= __('Insertar informe técnico') ?></legend>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Numero: <input type="text" name="technical_report_id">
  
  <br><br>
  Evaluación: <textarea type="text" name="evaluation" rows="5" cols="40"></textarea>
 <br><br>
  Recomendación:
  <input type="radio" name="recommendation" value="U">Reubicar
  <input type="radio" name="recommendation" value="P">Reparar
  <input type="radio" name="recommendation" value="E">Desechar

  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
