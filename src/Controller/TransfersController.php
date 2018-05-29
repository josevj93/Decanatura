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
        $transfer = $this->Transfers->get($id, [
            'contain' => ['Assets']
        ]);

        $this->set('transfer', $transfer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $transfer = $this->Transfers->newEntity();
        $tmpId= $this->Transfers->find('all',['fields'=>'transfers_id'])->last();
        $tmpId= $tmpId->transfers_id+1;
        if ($this->request->is('post')) {
            $transfer = $this->Transfers->patchEntity($transfer, $this->request->getData());
            $transfer->transfers_id = $tmpId;
            if ($this->Transfers->save($transfer)) {
                $transferAssetTable = TableRegistry::get('AssetsTransfers');
                $transferAsset = $transferAssetTable->newEntity();
                $transferAsset->transfers_id = $tmpId;
                $transferAsset->assets_id =  $this->request->getData('placa');
                if ($transferAssetTable->save($transferAsset)) {
                    $this->Flash->success(__('La transferencia fue exitosa.'));
                    return $this->redirect(['action' => 'index']);
                }
                
            }
            $this->Flash->error(__('No se pudo realizar la transferencia.'));
        }
        
        //Saco el ultimo id y le sumo 1
        

        //preguntar sobre posición de de fecha.
        $assets = $this->Transfers->Assets->find('list', ['limit' => 200]);//?????
        //$this->set(compact('technicalReport', 'assets','tmpId'));
        //cómo funciona el tercer parámetro?
        $this->set(compact('transfer', 'assets','tmpId'));



        //////////////////////////////////
        //base

        /*
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
        */
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
