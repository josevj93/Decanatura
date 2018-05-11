<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue $residue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $residue->residues_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $residue->residues_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Residues'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Edit Residue') ?></legend>
        <?php
            echo $this->Form->control('name1');
            echo $this->Form->control('identification1');
            echo $this->Form->control('name2');
            echo $this->Form->control('identification2');
            echo $this->Form->control('date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
