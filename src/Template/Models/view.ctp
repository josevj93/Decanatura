<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Model $model
 */
?>

<div class="models view large-9 medium-8 columns content">
    <h3><?= h($model->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($model->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($model->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Brand') ?></th>
            <td><?= h($model->id_brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Type') ?></th>
            <td><?= h($model->id_type) ?></td>
        </tr>
    </table>
</div>
