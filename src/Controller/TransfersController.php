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
        $tmpId= $this->Transfers->find('all',['fields'=>'transfers_id'])->last();
        $tmpId= $tmpId->transfers_id+1;
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            $transfer->transfers_id = $tmpId;


            //comienza el ciclo para agregar la relación entre activos y acta.


            if ($this->Transfers->save($transfer)) {


                
                $contador=0;
                //aquí se ocupa la placa
                /*
                
                debug($this->request->getData((string)$contador));
                $contador=1;
                debug($this->request->getData((string)$contador));
                $contador=2;
                debug($this->request->getData((string)$contador));
                $contador=0;
                */

                while(($this->request->getData((string)$contador)!=false) or
                 ($this->request->getData((string)$contador) == '0') )
                {
                    $transferAssetTable = TableRegistry::get('AssetsTransfers');
                $transferAsset = $transferAssetTable->newEntity();
                //se asigna id de traslado a tabla de relación
                $transferAsset->transfer_id = $tmpId;

                    //debug($this->request->getData((string)$contador));

                 if($this->request->getData((string)$contador) == '0')
                 {
                    $contador = $contador+1;
                 }
                 else
                 {
                     $transferAsset->assets_id =  $this->request->getData((string)$contador);
                     //debug($transferAssetTable->save($transferAsset));
                     $contador = $contador+1;
                     //se guarda en tabla conjunta (assets y traslado)
                     debug($transferAsset);
                     if ($transferAssetTable->save($transferAsset)) 
                     {
                     $this->Flash->success(__('La transferencia fue exitosa.'));
                     }
                     else
                        {
                            $this->Flash->error(__('No se pudo realizar la transferencia.'));
                        }
                        return $this->redirect(['action' => 'index']);
                 }
                

                }
            }
            $this->Flash->error(__('No se pudo realizar la transferencia.'));
        }
        
        /*
        CÓDIGO VIEJO
        $assets = $this->Transfers->Assets->find('list', ['limit' => 200]);//?????
        $this->set(compact('transfer', 'assets','tmpId'));
        */

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
        $query = $assets_transfers->find()
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


       

        if ($this->request->is(['patch', 'post', 'put'])) {


            //saco la lista de placas señaladas y luego las paso a Array
            $check= $this->request->getData("checkList");
            $check = explode(",",$check);
             
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('Los cambios han sido guardados.'));

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
