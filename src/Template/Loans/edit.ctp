<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Loan $loan
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $loan->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $loan->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Loans'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="loans form large-9 medium-8 columns content">
    <?= $this->Form->create($loan) ?>
    <fieldset>
        <legend><?= __('Edit Loan') ?></legend>
        <?php
            echo $this->Form->control('id_assets');
            echo $this->Form->control('id_responsables');
            echo $this->Form->control('fecha_inicio', ['empty' => true]);
            echo $this->Form->control('fecha_devolucion', ['empty' => true]);
            echo $this->Form->control('observaciones');
            echo $this->Form->control('estado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
