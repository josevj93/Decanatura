<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $transfer->transfers_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $transfer->transfers_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Transfers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="transfers form large-9 medium-8 columns content">
    <?= $this->Form->create($transfer) ?>
    <fieldset>
        <legend><?= __('Edit Transfer') ?></legend>
        <?php
            echo $this->Form->control('date');
            echo $this->Form->control('Acade_Unit_recib');
            echo $this->Form->control('functionary');
            echo $this->Form->control('identification');
            echo $this->Form->control('functionary_recib');
            echo $this->Form->control('identification_recib');
            echo $this->Form->control('assets._ids', ['options' => $assets]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
