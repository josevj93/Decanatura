<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
    use Cake\Routing\Router;
?>

<style>
        .btn-primary {
            margin: 10px;
            margin-top: 15px;
        }
		    .btn-default {
          color: #000;
          background-color: #7DC7EF;
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;

        }
		
        label {
          text-align:left;
          margin-right: 10px;
          
        }

        .sameLine{
          display: flex; 
          justify-content: space-between; 
          border-color: transparent;
        }
		
		.date{
          width:100px;
          margin-left: 10px;
        }
</style> 

<div class="locations form large-9 medium-8 columns content">
    <legend><?= __('Insertar préstamo') ?></legend>
    
    <br>

    <?= $this->Form->create($loan) ?>
    <div class="form-control sameLine">
			<div class="row col-lg-5">
				<label> <b>Responsable:</b><b style="color:red;">*</b> </label>
				<?php echo $this->Form->select('id_responsables', $users, array('empty' => true, 'class' => 'form-control col-md-7', 'id'=> 'userDropdown')); ?>
			</div>

			<div class="row">
				<label> <b>Fecha inicio:</b><b style="color:red;">*</b> </label>
				<?php echo $this->Form->imput('fecha_inicio', ['class'=>'form-control date', 'value' => date("y-m-d"), 'id'=>'datepicker']); ?>
			</div>
			
			<div class="row">
				<label> Fecha de devolución: </label>
                <?php echo $this->Form->imput('fecha_devolucion', ['class'=>'form-control date', 'id'=>'datepicker2']); ?>
			</div>
			
		</div> <br>
   
 <!-- AQUI ESTA LO IMPORTANTE. RECUERDEN COPIAR LOS SCRIPTS -->
        <div class="related">
            <legend><?= __('Asignación de activos a préstamo') ?></legend>
			<br>
            <!-- tabla que contiene  datos básicos de activos-->
            <table id='assets-transfers-grid' cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th class="transfer-h"><?= __('Placa') ?></th>
                        <th class="transfer-h"><?= __('Modelo') ?></th>
                        <th class="transfer-h"><?= __('Serie') ?></th>
                        <th class="transfer-h"><?= __('Seleccionados') ?></th>
                    </tr>
                <thead>
                <tbody>
                    <?php 
                      foreach ($result as $a): ?>
                      <tr>
                          <td><?= h($a->plaque) ?></td>
                          <td><?= h($a->models_id) ?></td>  
                          <td><?= h($a->series) ?></td>
                          <td><?php
                        
                                      echo $this->Form->checkbox('assets_id',
                                      ['value'=>htmlspecialchars($a->plaque),"class"=>"chk"]
                                      );
                                  
                              ?>
                              
                          </td>
                      </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>

        </div>

    <!-- input donde coloco la lista de placas checkeadas -->
    <input type="hidden" name="checkList" id="checkList">

    <br>

    <div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            <?php echo $this->Form->control('observaciones', array('label'=>'Observaciones', 'class' => 'form-control', 'rows' => '3')); ?>
        </div>
    </div>

    <br>

    <div class="col-12 text-right">

       
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
         <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary', 'id' => 'acept']) ?>

    </div>
    
    <?= $this->Form->end(); ?>

</div>

<script>

	$( function Picker() {
    $( "#datepicker" ).datepicker({ 
            dateFormat: 'y-mm-dd',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            dayNamesMin: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']
     });
  } );
  
	$( function Picker() {
    $( "#datepicker2" ).datepicker({ 
            dateFormat: 'y-mm-dd',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            dayNamesMin: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do']
     });
  } );

    /*prueba para autocompletar*/
    /*
    jQuery('#assetImput').autocomplete({
            source:'<?php echo Router::url(array('controller' => 'Loan', 'action' => 'getPlaques')); ?>',
            minLength: 2
        });
    */

    $(document).ready(function() 
    {
        $('#assets-transfers-grid').DataTable( {} );
    } );
    $(document).ready(function() 
    {
        $('#assets-transfers-grid').DataTable( {} );
    } );
    $("document").ready(
    function() {
      $('#acept').click( function()
      {
        var check = getValueUsingClass();
        $('#checkList').val(check);
        
        });
        }
    );
/** función optenida de http://bytutorial.com/blogs/jquery/jquery-get-selected-checkboxes */
    function getValueUsingClass(){
    /* declare an checkbox array */
    var chkArray = [];
    
    /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
    $(".chk:checked").each(function() {
        chkArray.push($(this).val());
    });
    
    /* we join the array separated by the comma */
    var selected;
    selected = chkArray.join(',') ;
    return selected;
}
</script>
