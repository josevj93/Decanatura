<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

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
}
