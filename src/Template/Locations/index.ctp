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
                        
                        <!--a class="nav-link" href="view/<?php echo $location->location_id;?>">
                            <i class="fa fa-fw fa-search"></i>
                        </a>
                        <a class="nav-link" href="edit/<?php echo $location->location_id;?>">
                            <i class="fa fa-fw fa-search"></i>
                        </a>
                        <a class="nav-link" href="delete/<?php echo $location->location_id;?>">
                            <i class="fa fa-fw fa-search"></i>
                        </a>
                        -->
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-eye')), ['action' => 'view', $location->location_id], array('escape' => false)) ?>
                        <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')), ['action' => 'edit', $location->location_id], array('escape' => false)) ?>
                        <?= $this->Form->postlink($this->Html->tag('i', '', array('class' => 'fa fa-trash')), ['action' => 'delete', $location->location_id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $location->location_id)]) ?>
                    </td>
                    <td><?= h($location->location_id) ?></td>
                    <td><?= h($location->description) ?></td>
                    <td><?= h($location->nombre) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
    
</div>
<form action="add"><input type="submit" value="Nueva Ubicacion" /></form>
<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#locations-grid').DataTable( {} );
    } );
</script>