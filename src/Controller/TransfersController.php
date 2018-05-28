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
                    ->where(['AssetsTransfers.transfers_id'=>$id])
                    ->toList();
        // Aqui paso el resultado de $query a un objeto
        $size = count($query);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }
        //$user =$this->Auth->user();
        

        $this->set(compact('transfer','result'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transfer = $this->Transfers->newEntity();
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('The transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer could not be saved. Please, try again.'));
        }
        $assets = $this->Transfers->Assets->find('list', ['limit' => 200]);
        $this->set(compact('transfer', 'assets'));
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
        $transfer = $this->Transfers->get($id, [
            'contain' => ['Assets']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            if ($this->Transfers->save($transfer)) {
                $this->Flash->success(__('The transfer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transfer could not be saved. Please, try again.'));
        }
        $assets = $this->Transfers->Assets->find('list', ['limit' => 200]);
        $this->set(compact('transfer', 'assets'));
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
