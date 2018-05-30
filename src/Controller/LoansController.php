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
        $loan = $this->Loans->newEntity();
        if ($this->request->is('post')) {
            $random = uniqid();
            $loan->id = $random;
            $loan = $this->Loans->patchEntity($loan, $this->request->getData());
            
            if ($this->Loans->save($loan)) {
                $asset= $this->Asset->get($loan->id_assets, [
                    'contain' => []
                ]);

                $asset->estado = 'Prestado';

                if($this->Assets->save($loan)){
                    $this->Flash->success(__('El préstamo fue guardado exitosamente.'));
                    return $this->redirect(['action' => 'index']);
                }

            }
            $this->Flash->error(__('El préstamo no se pudo guardar, por favor intente nuevamente.'));
        }       

        $assets = $this->Loans->Assets->find('list', ['limit' => 200]);
        $users = $this->Loans->Users->find('list', ['limit' => 200]);
        $this->set(compact('assets', 'loan', 'users'));
    }
}
