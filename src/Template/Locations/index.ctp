<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Location[]|\Cake\Collection\CollectionInterface $locations
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Location'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="locations index large-9 medium-8 columns content">
    <h3><?= __('Locations') ?></h3>
    <form  method="post" id="cart">
    <table id="locations-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nombre') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location): ?>
            <tr>
                <td class="actions">
                    <a class="nav-link" href="view/<?php echo $location->location_id;?>">
                        <i class="fa fa-fw fa-dashboard"></i>
                    </a>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $location->location_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $location->location_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $location->location_id], ['confirm' => __('Are you sure you want to delete # {0}?', $location->location_id)]) ?>
                </td>
                <td><?= h($location->location_id) ?></td>
                <td><?= h($location->description) ?></td>
                <td><?= h($location->nombre) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </form>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#locations-grid').DataTable( {} );
    } );
</script>