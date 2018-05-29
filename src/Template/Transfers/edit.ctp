<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transfer $transfer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">

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
            //echo $this->Form->control('assets._ids', ['options' => $assets]);
        ?>
    </fieldset>

    <div class="related">
        <legend><?= __('Activos a trasladar') ?></legend>

        <table id='assets-transfers-grid' cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="transfer-h"><?= __('Placa') ?></th>
                    <th class="transfer-h"><?= __('Marca') ?></th>
                    <th class="transfer-h"><?= __('Modelo') ?></th>
                    <th class="transfer-h"><?= __('Serie') ?></th>
                    <th class="transfer-h"><?= __('Estado') ?></th>
                    <th class="transfer-h"><?= __('Seleccionados') ?></th>
                </tr>
            <thead>
            <tbody>
                <?php //debug($asset)?>
                <?php //debug(array_column($result, 'plaque'))?>
                <?php foreach ($asset as $a): ?>
                <tr>
                    <td><?= h($a->plaque) ?></td>
                    <td><?= h($a->brand) ?></td>
                    <td><?= h($a->model) ?></td>
                    <td><?= h($a->series) ?></td>
                    <td><?= h($a->state) ?></td>
                    <td><?php
                        //debug($a->plaque);
                        $isIn= in_array($a->plaque, array_column($result, 'plaque') );

                        if($isIn)
                            {
                                echo $this->Form->checkbox('assets_id',
                                ['value'=>htmlspecialchars($a->plaque),'checked']
                                );
                            }
                        else
                            {
                                echo $this->Form->checkbox('assets_id',
                                ['value'=>htmlspecialchars($a->plaque)]
                                );
                            }

                        ?>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>



<script type="text/javascript">
    $(document).ready(function() 
    {
        $('#assets-transfers-grid').DataTable( {} );
    } );
</script>