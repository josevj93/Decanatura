<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
 * Transfers Controller
 *
 * @property \App\Model\Table\TransfersTable $Transfers
 *
 * @method \App\Model\Entity\Transfer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransfersController extends AppController
{



    private $UnidadAcadémica='Ingeniería';


 public function isAuthorized($user)
    {

        $this->Roles = $this->loadModel('Roles');
        $this->Permissions = $this->loadModel('Permissions');
        $this->RolesPermissions = $this->loadModel('RolesPermissions');

        $allowI = false;
        $allowM = false;
        $allowE = false;
        $allowC = false;
        
        $query = $this->Roles->find('all', array(
                    'conditions' => array(
                        'id' => $user['id_rol']
                    )
                ))->contain(['Permissions']);

        foreach ($query as $roles) {
            $rls = $roles['permissions'];
            foreach ($rls as $item){
                //$permisos[(int)$item['id']] = 1;
                if($item['nombre'] == 'Insertar Usuarios'){
                    $allowI = true;
                }else if($item['nombre'] == 'Modificar Usuarios'){
                    $allowM = true;
                }else if($item['nombre'] == 'Eliminar Usuarios'){
                    $allowE = true;
                }else if($item['nombre'] == 'Consultar Usuarios'){
                    $allowC = true;
                }
            }
        } 


        $this->set('allowI',$allowI);
        $this->set('allowM',$allowM);
        $this->set('allowE',$allowE);
        $this->set('allowC',$allowC);


        if ($this->request->getParam('action') == 'add'){
            return $allowI;
        }else if($this->request->getParam('action') == 'edit'){
            return $allowM;
        }else if($this->request->getParam('action') == 'delete'){
            return $allowE;
        }else if($this->request->getParam('action') == 'view'){
            return $allowC;
        }else{
            return $allowC;
        }


    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $transfers = $this->paginate($this->Transfers);

        $this->set(compact('transfers'));
    }

    /**
     * View method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $transfer = $this->Transfers->get($id);

        // obtengo la tabla assets
        $assets_transfers = TableRegistry::get('AssetsTransfers');

        // reallizo un join  a assets_tranfers para obtener los activos
        //asosiados a un traslado
        $query = $assets_transfers->find()
                    ->select(['assets.plaque','assets.brand','assets.model','assets.series','assets.state'])
                    ->join([
                      'assets'=> [
                        'table'=>'assets',
                        'type'=>'INNER',
                        'conditions'=> [ 'assets.plaque= AssetsTransfers.assets_id']
                        ]
                    ])
                    ->where(['AssetsTransfers.transfer_id'=>$id])
                    ->toList();

        // Aqui paso el resultado de $query a un objeto para manejarlo facilmente en la vista
        $size = count($query);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }
        //$user =$this->Auth->user();
        
        $Unidad= $this->UnidadAcadémica;

        $this->set(compact('transfer','result','Unidad'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        // obtengo la tabla assets
        $assets_transfers = TableRegistry::get('AssetsTransfers');

        // reallizo un join  a assets_tranfers para obtener los activos
        //asosiados a un traslado
        $query = $assets_transfers->find()
                    ->select(['assets.plaque'])
                    ->join([
                      'assets'=> [
                        'table'=>'assets',
                        'type'=>'INNER',
                        'conditions'=> [ 'assets.plaque= AssetsTransfers.assets_id']
                        ]
                    ])
                    ->toList();
        // Aqui paso el resultado de $query a un objeto
        $size = count($query);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }


        //empieza el área para la función de post///////////////
        $transfer = $this->Transfers->newEntity();
        $tmpId = 1;
        $tmpId = $this->Transfers->find('all',['fields'=>'transfers_id'])->last();
        if($tmpId!=null)
        {
            $tmpId = $tmpId->transfers_id+1;
        }
        else
        {
            $tmpId = 1;
        }
        if ($this->request->is('post')) {
            $check= $this->request->getData("checkList");
            $check = explode(",",$check);
            if($check['0'] == null)
            {
                $this->Flash->error(__('No se pudo realizar la transferencia porque no se seleccionó ningún activo.'));
            }
            else
            {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            //tmpId contiene el id de la tabla de traslados.
            $transfer->transfers_id = $tmpId;
            //comienza el ciclo para agregar la relación entre activos y acta.
            if ($this->Transfers->save($transfer)) {
                //se saca la lista de placas señaladas y luego se pasan a Array
                $check= $this->request->getData("checkList");
                $check = explode(",",$check);
                foreach($check as $placa)
                {
                $transferAssetTable = TableRegistry::get('AssetsTransfers');
                $transferAsset = $transferAssetTable->newEntity();
                //se asigna id de traslado a tabla de relación
                $transferAsset->transfer_id = $tmpId;
                $transferAsset->assets_id = $placa;
                //se guarda en tabla conjunta (assets y traslado)
                $transferAssetTable->save($transferAsset);
                }
                $this->Flash->success(__('La transferencia fue exitosa.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo realizar la transferencia.'));
            }
        }
        //Buscca los activos para cargarlos en el grid.
        $assetsQuery = TableRegistry::get('Assets');
        $assetsQuery = $assetsQuery->find()
                         ->select(['assets.plaque','assets.brand','assets.model','assets.series','assets.state'])
                         ->toList();
        $size = count($assetsQuery);
        $asset=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $asset[$i] =(object)$assetsQuery[$i]->assets;
        }
        $this->set(compact('transfer', 'asset', 'result','tmpId'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transfer = $this->Transfers->get($id);

        // obtengo la tabla assets
        $assets_transfers = TableRegistry::get('AssetsTransfers');

        // reallizo un join  a assets_tranfers para obtener los activos
        //asosiados a un traslado
        $query = $assets_transfers
                    ->find('all')
                    ->select(['assets.plaque'])
                    ->join([
                      'assets'=> [
                        'table'=>'assets',
                        'type'=>'INNER',
                        'conditions'=> [ 'assets.plaque= AssetsTransfers.assets_id']
                        ]
                    ])

                    ->where(['AssetsTransfers.transfer_id'=>$id])

                    ->toList();
        // Aqui paso el resultado de $query a un objeto
        $size = count($query);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }       
        //debug($result);
        if ($this->request->is(['patch', 'post', 'put'])) {


            //saco la lista de placas señaladas y luego las paso a Array
            $check= $this->request->getData("checkList");
            $checks = explode(",",$check);
             
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('Los cambios han sido guardados.'));

                
                $temp =  array_fill(0, $size, NULL);
                $i=0;
                foreach ($result as $res)
                {
                    $temp[$i] = $res -> plaque;
                    $i++;
                }

                $nuevos = array_diff($checks,  $temp);
                $viejos = array_diff($temp,  $checks);
                
                
                //debug($nuevos);
                //debug($viejos);

                if (count($viejos) > 0)
                  $assets_transfers->deleteall(array('transfer_id'=>$id, 'assets_id IN' => $viejos), false);

                if (count($nuevos) > 0)
                {
                    foreach ($nuevos as $n)
                    {
                        $at = TableRegistry::get('AssetsTransfers')->newEntity([
                                'transfer_id'=> $id,
                                'assets_id' => $n
                        ]);

                        $at->assets_id = $n;
                        $at->transfer_id = $id;
                        
                        $assets_transfers->save($at);
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
  
            $this->Flash->error(__('El traslado no se pudo guardar, porfavor intente nuevamente'));

        }



        $assetsQuery = TableRegistry::get('Assets');
        $assetsQuery = $assetsQuery->find()
                         ->select(['assets.plaque','assets.brand','assets.model','assets.series','assets.state'])
                         ->toList();

        $size = count($assetsQuery);
        $asset=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $asset[$i] =(object)$assetsQuery[$i]->assets;
        }

        $Unidad= $this->UnidadAcadémica;
        $this->set(compact('transfer', 'asset', 'result','Unidad'));

    }

    /**
     * Delete method
     *
     * @param string|null $id Transfer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transfer = $this->Transfers->get($id);
        
        if ($this->Transfers->delete($transfer)) {
            $this->Flash->success(__('The transfer has been deleted.'));
        } else {
            $this->Flash->error(__('The transfer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


public function download($id = null)
    {

        $this->Assets = $this->loadModel('Assets');
        $this->AssetsTransfers = $this->loadModel('AssetsTransfers');

        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT * FROM assets
            inner join assets_transfers on plaque = assets_id
            inner join transfers on transfer_id = transfers_id
            where transfers_id =' . $id . ';');

        $results = $stmt ->fetchAll('assoc');


         require_once 'dompdf/autoload.inc.php';
        //initialize dompdf class
        $document = new Dompdf();
        $html = 
        '<p><strong><sup>&nbsp;</sup></strong></p>
<p><strong>Universidad de Costa Rica</strong></p>
<p><strong>Vicerrector&iacute;a de Administraci&oacute;n</strong></p>
<p><strong>Oficina de Administraci&oacute;n Financiera</strong></p>
<h1>Unidad de Control de Activos Fijos y Seguros</h1>
<p><strong>***Tel. 207-5045 / 2075759 ** Fax 253-4630***</strong></p>
<h2>FORMULARIO PARA TRASLADO DE ACTIVOS FIJOS</h2>
<h1>&nbsp;</h1>
<h1>Fecha: 13/06/2015&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.__________________</h1>
<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><strong>(Lo asigna el usuario)</strong></p>
<p><strong>&nbsp;</strong></p>
<table width="0" border="1">
<tbody>
<tr>
<td width="360">
<p><strong>ENTREGA</strong></p>
</td>
<td width="324">
<p><strong>RECIBE</strong></p>
</td>
</tr>
<tr>
<td width="360">
<p><strong>Unidad: Decanato de la Facultad Ingenier&iacute;a</strong></p>
<p><strong>&nbsp;</strong></p>
</td>
<td width="324">
<p><strong>Unidad:</strong></p>
</td>
</tr>
<tr>
<td width="360">
<p><strong>Nombre del Funcionario:</strong></p>
<p><strong>&nbsp;</strong></p>
</td>
<td width="324">
<p><strong>Nombre del Funcionario:</strong></p>
</td>
</tr>
<tr>
<td width="360">
<p><strong>Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&eacute;dula:</strong></p>
<p><strong>&nbsp;</strong></p>
</td>
<td width="324">
<p><strong>Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&eacute;dula:</strong></p>
</td>
</tr>
</tbody>
</table>
<h2>Detalle de los bienes a trasladar</h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="0" border="1">
<tbody>
<tr>
<th>Placa</th>
<th>Marca</th>
<th>Modelo</th>
<th>Serie</th>
<th>Estado Actual</th>
</tr>';

        foreach ($results as $item) {
            $html .= 
            '<tr>
             <td>' . $item['plaque'] . '</td>
             <td>' . $item['brand'] . '</td>
             <td>' . $item['model'] . '</td>
             <td>' . $item['series'] . '</td>
             <td>' . $item['state'] . '</td>
             </tr>';
        }


$html .=

'</table>
<br><br><br>
<p><strong>&nbsp;</strong></p>
<p><strong>&nbsp;</strong></p>
<p><strong>Observaciones: </strong></p>
<p><strong>Nota: El formulario debe estar firmado por el encargado de activos fijos u otro funcionario autorizado en cada unidad.</strong></p>
<h3>&nbsp;</h3>
<h3>Original: Oficina de Administraci&oacute;n Financiera&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Copia: Unidad que entrega&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Copia: Unidad que recibe</h3>
    ';


        $document->loadHtml($html);

        //set page size and orientation
        $document->setPaper('A3', 'landscape');
        //Render the HTML as PDF
        $document->render();
        //Get output of generated pdf in Browser
        $document->stream("Formulario de Traslado", array("Attachment"=>1));
        //1  = Download
        //0 = Preview
        return $this->redirect(['action' => 'index']);

    }






}
