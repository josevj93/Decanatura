 <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TechnicalReport $technicalReport
 */
   use Cake\Routing\Router;
?>

<div class="residues form large-9 medium-8 columns content">
    <?= $this->Form->create($residue) ?>
    <fieldset>
        <legend><?= __('Modificar acta de desecho') ?></legend>
        <br>    
        <div class='row'>
            <label>Fecha:</label>
            <?php
            $tmpDate= $residue->date->format('y-m-d');
            echo $this->Form->imput('date', ['class'=>'form-control ', 'value'=>$tmpDate, 'disabled']); 
            ?>
        </div><br>


        <label>En presencia de:</label>
        <table>
            <tr>
                <td><br>
                    <div class="row">
                            <label class='label-t'>Nombre:  </label>
                                <?php 
                                    echo $this->Form->imput('name1', ['class'=>'form-control col-sm-6']);
                                ?>
                    </div><br>
                    <div class="row">
                            <label class='label-t'>Cédula:  </label>
                                <?php 
                                    echo $this->Form->imput('identification1', ['class'=>'form-control col-sm-6']);
                                ?>
                    </div><br>
                </td>
            
                <td><br>
                    <div class="row">
                            <label class='label-t'>Nombre:</label>
                                <?php 
                                    echo $this->Form->imput('name2', ['class'=>'form-control col-sm-6']);
                                ?>
                    </div><br>
                    <div class="row">
                            <label class='label-t'>Cédula:  </label>
                                <?php 
                                    echo $this->Form->imput('identification2', ['class'=>'form-control col-sm-6']);
                                ?> 
                    </div><br>
                </td>
            </tr>
        </table>

    
    </fieldset>
    </div>

    

    <style>
    .btn-primary {
      color: #FFF;
      background-color: #0099FF;
      border-color: #0099FF;
      float: right;
      margin-left: 10px;
    }

    label {
          text-align:left;
          margin-right: 10px;
          
    }

    label[class=label-t]{
        margin-left: 20px;
    }

    input[name=date]{
          width:100px;
          margin-left: 10px;
        }

    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    td {

        border: 1px solid #000000;
        border-bottom: 1px solid #000000;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style> 

    
    <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>
    </div>

    <script>
            
    </script>