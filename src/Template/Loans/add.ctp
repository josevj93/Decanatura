<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
    use Cake\Routing\Router;
?>

<div class="locations form large-8 medium-8 small-12 columns content">
    <legend><?= __('Insertar prestamo') ?></legend>
    
    <br>

    <?= $this->Form->create($loan) ?>

    <div class = "row">
        <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
            <?php echo $this->Form->control('id_responsables', array('options' => $users,'label'=>'Responsable', 'class' => 'form-control', 'id'=> 'userDropdown')); ?>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4 col-lg-4 offset-lg-4">
            <label>Fecha inicio:</label>
                <?php
                    echo $this->Form->imput('fecha_inicio', ['class'=>'form-control ','id'=>'datepicker', 'value' => date("d-m-y")]); 
                ?>
        </div>
    </div>

    <div id=userResult> 
    </div>

    <br>

    <div class = "row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <label>Placa del activo:</label><br>
            <div class='input-group mb-3'>
                <?php 
                    echo $this->Form->imput('assets_id',['class'=>'form-control col-sm-3', 'id'=>'assetImput'])
                ?>

                <div class= 'input-group-append'>
                    <?php 
                        echo $this->Html->link('Buscar','#',['type'=>'button','class'=>'btn btn-outline-secondary','id'=>'assetButton','onclick'=>'return false']);
                    ?>
                </div>

            </div>
        </div>
    </div>

    <br>

    <div id=assetResult> 
    </div>

    <br>

    <div class="row">
        <div class="col-md-4 col-xs-12 col-lg-4 col-sm-12">
            <label>Fecha de devolución:</label>
                <?php
                echo $this->Form->imput('fecha_devolucion', ['class'=>'form-control ','id'=>'datepicker2']); 
                ?>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <?php echo $this->Form->control('observaciones', array('label'=>'Observaciones', 'class' => 'form-control', 'rows' => '3')); ?>
        </div>
    </div>

    <br>

    <div class="col-12 text-right">

        <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link(__('Cancelar'), ['controller' => 'Assets', 'action' => 'index'], ['class' => 'btn btn-primary']) ?>

    </div>
    
    <?= $this->Form->end(); ?>

</div>

<script>
    /*prueba para autocompletar*/
    /*
    jQuery('#assetImput').autocomplete({
            source:'<?php echo Router::url(array('controller' => 'Loan', 'action' => 'getPlaques')); ?>',
            minLength: 2
        });
    */
    $( function Picker() {
        $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-y' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'dd-mm-y' });
    } );
    $("document").ready(
        function() {
        $('#assetButton').click( function()
        {
            var plaque = $('#assetImput').val();
            if(''!=plaque)
            {
            $.ajax({
                    type: "GET",
                    url: '<?php echo Router::url(['controller' => 'Loans', 'action' => 'searchAsset' ]); ?>',
                    data:{id:plaque},
                    beforeSend: function() {
                        $('#assetResult').html('<label>Cargando</label><i class="fa fa-spinner fa-spin" style="font-size:25px"></i>');
                        },
                    success: function(msg){
                        $('#assetResult').html(msg);
                        },
                    error: function(e) {
                        alert("Ocurrió un error: artículo no encontrado.");
                        console.log(e);
                        $('#assetResult').html('Introdusca otro número de placa.');
                        }
                });
            
            }
            else
            {
            $('#assetResult').html('Primero escriba un número de placa.');
            }
        });
        }
    );

</script>
