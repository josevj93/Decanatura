<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $technicalReport->technical_report_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $technicalReport->technical_report_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Technical Reports'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="technicalReports form large-9 medium-8 columns content">
    <?= $this->Form->create($technicalReport) ?>
    <fieldset>
        <legend><?= __('Edit Technical Report') ?></legend>
        <?php
            echo $this->Form->control('date');
            echo $this->Form->control('assets_id', ['options' => $assets]);
            echo $this->Form->control('evaluation');
            echo $this->Form->control('recommendation');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
