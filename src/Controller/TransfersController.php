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
                    ->select(['assets.plaque','brands.name','models.name','assets.series','assets.state'])
                    ->join([
                      'assets'=> [
                        'table'=>'assets',
                        'type'=>'INNER',
                        'conditions'=> [ 'assets.plaque= AssetsTransfers.assets_id']
                        ]
                    ])
                    ->join([
                            'models' => [
                                    'table' => 'models',
                                    'type'  => 'LEFT',
                                    'conditions' => ['assets.models_id= models.id']
                                ]
                                ])
                    ->join([
                            'brands' => [
                                    'table' => 'brands',
                                    'type'  => 'LEFT',
                                   'conditions' => ['models.id_brand = brands.id']
                                ]
                    ])
                    ->where(['AssetsTransfers.transfer_id'=>$id])
                    ->toList();

        
        $size = count($query);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            //* se acomodan los valores dentro de un mismo [$i]
            $result[$i]['plaque']= $query[$i]->assets['plaque'];
            $result[$i]['brand']= $query[$i]->brands['name'];
            $result[$i]['model']= $query[$i]->models['name'];
            $result[$i]['series']= $query[$i]->assets['series'];
            $result[$i]['state']= $query[$i]->assets['state'];

            // se realiza una conversion a objeto para que la vista lo use sin problemas
            $result[$i]= (object)$result[$i];

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
        //empieza el área para la función de post///////////////
        $transfer = $this->Transfers->newEntity();
        
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
            //Se concatena el id de la vista con la constante en este caso (VRA-) que es diferente para cada unidad académica
            $transfer->transfers_id = "VRA-".$this->request->getData('transfers_id');
            $users = TableRegistry::get('users');
            //se obtiene el nombre del usuario con la posición del dropdown
            $users_query = $users->find()
            ->select(['users.nombre','users.apellido1','users.apellido2'])->toList();

            $array_funcionario = $users_query[$transfer->functionary];
            $transfer->functionary = $array_funcionario->nombre.' '.$array_funcionario->apellido1.' '.$array_funcionario->apellido2;
            //Se verifica que el id no esté duplicado, por alguna razón la base de datos no lo estaba haciendo.
            $tmpId = $this->Transfers->find('all',['fields'=>'transfers_id'])
            ->where(['transfers_id'=> $transfer->transfers_id])->toList();
            if($tmpId == null)
            {
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
                $transferAsset->transfer_id =  $transfer->transfers_id;
                $transferAsset->assets_id = $placa;
                //se guarda en tabla conjunta (assets y traslado)
                $transferAssetTable->save($transferAsset);

                //Se le cambia el estado al activo.
                $assets = TableRegistry::get('Assets')->find('all');
                        
                         $assets->update()
                                ->set(['state' => "Trasladado"])
                                ->where(['plaque IN' => $placa])
                                ->execute();


                }
                $this->Flash->success(__('La transferencia fue exitosa.'));
                return $this->redirect(['action' => 'index']);
            }

           
            $this->Flash->error(__('No se pudo realizar la transferencia.'));
        }
        else{
                $this->Flash->error(__('No se pudo realizar la transferencia porque ya hay un traslado con ese número de traslado.'));
            }
            }
        }
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

        //Buscca los activos para cargarlos en el grid.
        $assetsQuery = TableRegistry::get('Assets');
        $assetsQuery = $assetsQuery->find()
                        ->select(['assets.plaque','brands.name','models.name','assets.series','assets.state'])
                        ->join([
                            'models' => [
                                    'table' => 'models',
                                    'type'  => 'LEFT',
                                    'conditions' => ['assets.models_id= models.id']
                                ]
                                ])
                        ->join([
                            'brands' => [
                                    'table' => 'brands',
                                    'type'  => 'LEFT',
                                   'conditions' => ['models.id_brand = brands.id']
                                ]
                        ])
                        ->where(['assets.state = "Disponible"'])
                        ->toList();
        $size = count($assetsQuery);
        $asset=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            //* se acomodan los valores dentro de un mismo [$i]
            $asset[$i]['plaque']= $assetsQuery[$i]->assets['plaque'];
            $asset[$i]['brand']= $assetsQuery[$i]->brands['name'];
            $asset[$i]['model']= $assetsQuery[$i]->models['name'];
            $asset[$i]['series']= $assetsQuery[$i]->assets['series'];
            $asset[$i]['state']= $assetsQuery[$i]->assets['state'];

            // se realiza una conversion a objeto para que la vista lo use sin problemas
            $asset[$i]= (object)$asset[$i];
        }

        /** obtengo una lista de usuarios para cargar un dropdown list en la vista */
        $usersTable= TableRegistry::get('Users');
        $queryUsers = $usersTable->find()
                        ->select(['users.nombre','users.apellido1','users.apellido2'])
                        ->toList();

        $size = count($queryUsers);
        $users= array_fill(0, $size, NULL);
        /** se concatena el nombre y se coloca en un mismo array*/
        for($i=0;$i<$size;$i++)
        {
            $users[$i] =$queryUsers[$i]->users['nombre'] ." ".$queryUsers[$i]->users['apellido1']." ".$queryUsers[$i]->users['apellido2'];
        }
        // variable para colocar la unidad que entrega
        $paramUnidad = $this->UnidadAcadémica;
        $this->set(compact('transfer', 'asset', 'result','tmpId','users','paramUnidad'));

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

        // realizo un join  a assets_tranfers para obtener los activos
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

         /** Se colocan el contenido de $result en un array llamado $temp de manera
        que se pueda usar el método arrar_diff facilmente y para consultar los activos
        que previamente pertenecen al traslado que se edita*/


        $temp =  array_fill(0, $size, NULL);
        $i=0;
        foreach ($result as $res)
        {
            $temp[$i] = $res -> plaque;
            $i++;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {


            //saco la lista de placas señaladas y luego las paso a Array
            $check= $this->request->getData("checkList");
            $checks = explode(",",$check);
             
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('Los cambios han sido guardados.'));



                $nuevos = array_diff($checks,  $temp);
                $viejos = array_diff($temp,  $checks);
                
                
                //debug($nuevos);
                //debug($viejos);

                $assets = TableRegistry::get('Assets')->find('all');

                if (count($viejos) > 0)
                {
                  $assets_transfers->deleteall(array('transfer_id'=>$id, 'assets_id IN' => $viejos), false);

                  $assets->update()
                    ->set(['state' => "Disponible"])
                    ->where(['plaque IN' => $viejos])
                    ->execute();
                }

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

                    $assets->update()
                    ->set(['state' => "Trasladado"])
                    ->where(['plaque IN' => $nuevos])
                    ->execute();
                }
                return $this->redirect(['action' => 'index']);
            }
  
            $this->Flash->error(__('El traslado no se pudo guardar, porfavor intente nuevamente'));

        }



        $assetsQuery = TableRegistry::get('Assets');
        $assetsQuery = $assetsQuery->find()
                        ->select(['assets.plaque','brands.name','models.name','assets.series','assets.state'])
                        ->join([
                            'models' => [
                                    'table' => 'models',
                                    'type'  => 'LEFT',
                                    'conditions' => ['assets.models_id= models.id']
                                ]
                                ])
                        ->join([
                            'brands' => [
                                    'table' => 'brands',
                                    'type'  => 'LEFT',
                                   'conditions' => ['models.id_brand = brands.id']
                                ]
                        ])
                        ->join([
                      'assets_transfers'=> [
                        'table'=>'assets_transfers',
                        'type'=>'LEFT',
                        'conditions'=> [ 'assets.plaque= assets_transfers.assets_id']
                        ]
                        ])

                        ->where(['assets.state = "Disponible" or assets_transfers.transfer_id = "'.$id.'"'])
                        ->toList();
        $size = count($assetsQuery);
        $asset=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            //* se acomodan los valores dentro de un mismo [$i]
            $asset[$i]['plaque']= $assetsQuery[$i]->assets['plaque'];
            $asset[$i]['brand']= $assetsQuery[$i]->brands['name'];
            $asset[$i]['model']= $assetsQuery[$i]->models['name'];
            $asset[$i]['series']= $assetsQuery[$i]->assets['series'];
            $asset[$i]['state']= $assetsQuery[$i]->assets['state'];

            // se realiza una conversion a objeto para que la vista lo use sin problemas
            $asset[$i]= (object)$asset[$i];
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
        
        // Obtengo el transfer que necesito eliminar
        $transfer = $this->Transfers->get($id);
        
        // Con el ID del transfer, obtengo el todos los Transfers_Assets Relacionados al mismo transfer desde la tabla 
        // intermedia Assets_Transfers
        $assets_transfers = TableRegistry::get('AssetsTransfers')->find()->where(['transfer_id' => $transfer->transfers_id]);
        
        // Proceseo para actualizar el estado del activo en la tabla de activos
        
        // Itero sobre cada Asset_Transfer en la variable indTransfer
        foreach ($assets_transfers as $indTransfer) {
                
                // Obtengo el asset ID associado a éste transfer particular
                $assetID = $indTransfer->assets_id;
                
                // Obtengo el asset correspondiente a éste transfer
                $assets = TableRegistry::get('Assets')->find()->where(['plaque' => $assetID]);
                  
                //se actualiza el estado del activo en la tabla de activos
                $assets->update()
                ->set(['state' => "Disponible"])
                ->where(['plaque' => $assetID])
                ->execute();
                
            }    

        if ($this->Transfers->delete($transfer)) {
            $this->Flash->success(__('El traslado a sido eliminado.'));
        } else {
            $this->Flash->error(__('El traslado no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     public function download($id = null)
    {

        $transfer = $this->Transfers->get($id, [
            'contain' => ['Assets']
        ]);

        // linea para marcar el traslado como descargado, haciendo que ya no se pueda borrar
        $transfer->descargado = true;

        // Actualizo el traslado, guardando el valor de descargado como true
        $this->Transfers->save($transfer);

        return $this->redirect(['action' => 'index']);
    }
}
