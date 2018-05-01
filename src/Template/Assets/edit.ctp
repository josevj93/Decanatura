<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $asset->plaque],
                ['confirm' => __('Are you sure you want to delete # {0}?', $asset->plaque)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assets form large-9 medium-8 columns content">
    <?= $this->Form->create($asset) ?>
    <fieldset>
        <legend><?= __('Edit Asset') ?></legend>
        <?php
            echo $this->Form->control('type_id', ['options' => $types]);
            echo $this->Form->control('brand');
            echo $this->Form->control('model');
            echo $this->Form->control('series');
            echo $this->Form->control('description');
            echo $this->Form->control('state');
            echo $this->Form->control('owner_id');
            echo $this->Form->control('responsable_id', ['options' => $users, 'empty' => true]);
            echo $this->Form->control('location_id', ['options' => $locations]);
            echo $this->Form->control('sub_location');
            echo $this->Form->control('year');
            echo $this->Form->control('lendable');
            echo $this->Form->control('lot');
            echo $this->Form->control('observations');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
