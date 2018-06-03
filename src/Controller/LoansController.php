<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Loans Controller
 *
 * @property \App\Model\Table\LoansTable $Loans
 *
 * @method \App\Model\Entity\Loan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoansController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $loans = $this->paginate($this->Loans);

        $this->set(compact('loans'));
    }

    /**
     * View method
     *
     * @param string|null $id Loan id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $loan = $this->Loans->get($id, [
            'contain' => []
        ]);

        $this->set('loan', $loan);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Assets');

        $loan = $this->Loans->newEntity();
        if ($this->request->is('post')) {
            $random = uniqid();
            $loan->id = $random;
            $loan->estado = 'Activo';
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            
            if ($this->Loans->save($asset)) {
                $asset= $this->Assets->get($loan->id_assets, [
                    'contain' => []
                ]);

                $asset->state = 'Disponible';
                $asset->deletable = false;

                if($this->Assets->save($asset)){
                    $this->Flash->success(__('El préstamo fue guardado exitosamente.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('El préstamo no se pudo guardar, por favor intente nuevamente.'));
        }       
        $assets = $this->Loans->Assets->find('list', [
            'conditions' => ['assets.state' => 'Disponible']
        ]);
        $users = $this->Loans->Users->find('list', ['limit' => 200]);
        $this->set(compact('assets', 'loan', 'users'));
    }

    public function cancel($id)
    {
        $this->loadModel('Assets');
        
        $loan = $this->Loans->get($id, [
            'contain' => []
        ]);
        
        
        $loan->estado = 'Cancelado';
        
        if ($this->Loans->save($loan)){
            
            $assets = $this->Assets->find('list', [
                'conditions' => ['assets.loans_id' => $id]
            ]);
                
            foreach($assets as $asset){
                $asset->state = 'Disponible';

                if(!($this->Assets->save($asset))){
                    $this->Flash->success(__('Error al cancelar el préstamo'));
                    return $this->redirect(['action' => 'index']);
                }
            }
        }
        $assets = $this->Loans->Assets->find('list', ['limit' => 200]);
        $users = $this->Loans->Users->find('list', ['limit' => 200]);
        $this->set(compact('assets', 'loan', 'users'));
    }

    public function getPlaques()
    {
        pr('Sirve');
        exit();
        $this->loadModel('Assets');
        if ($this->requrest->is('ajax')) {
            $this->autoRender = false;

            $plaqueRequest = $this->request->query['term'];
            $results = $this->Assets->find($id, [
                'conditions' => [ 'OR' => [
                    'plaque LIKE' => $plaqueRequest . '%',
                    ]
                ]
            ]);
            
            $resultsArr = [];
            
            foreach ($results as $result) {
                $resultsArr[] =['label' => $result['plaque'], 'value' => $result->plaque];
            }
            
            echo json_encode($resultsArr);

        }
    }

    public function searchAsset()
    {
        $this->loadModel('Assets');
        $id = $_GET['id'];
        $searchedAsset= $asset= $this->Assets->get($id, [
                    'contain' => []
                ]);
        if(empty($searchedAsset) )
        {
            throw new NotFoundException(__('Activo no encontrado') );      
        }
        $this->set('serchedAsset', $searchedAsset);

        /*Asocia esta función a la vista /Templates/Layout/searchAsset.ctp*/
        $this->render('/Layout/searchAsset');
    }
}