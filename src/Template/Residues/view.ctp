<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Residue $residue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Residue'), ['action' => 'edit', $residue->residues_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Residue'), ['action' => 'delete', $residue->residues_id], ['confirm' => __('Are you sure you want to delete # {0}?', $residue->residues_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Residues'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Residue'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="residues view large-9 medium-8 columns content">
    <h3><?= h($residue->residues_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Residues Id') ?></th>
            <td><?= h($residue->residues_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name1') ?></th>
            <td><?= h($residue->name1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identification1') ?></th>
            <td><?= h($residue->identification1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name2') ?></th>
            <td><?= h($residue->name2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identification2') ?></th>
            <td><?= h($residue->identification2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($residue->date) ?></td>
        </tr>
    </table>
</div>
