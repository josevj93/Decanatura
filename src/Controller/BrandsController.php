<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Brands Controller
 *
 * @property \App\Model\Table\BrandsTable $Brands
 *
 * @method \App\Model\Entity\Brand[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BrandsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $brands = $this->paginate($this->Brands);

        $this->set(compact('brands'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $brand = $this->Brands->newEntity();
        if ($this->request->is('post')) {
            $random = uniqid();
            $brand->id = $random;
            $brand = $this->Brands->patchEntity($brand, $this->request->getData());
            
            if ($this->Brands->save($brand)) {
                $this->Flash->success(__('La marca fue guardada exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La marca no se pudo guardar, por favor intente nuevamente.'));
        }
        $this->set(compact('brand'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Brand id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $brand = $this->Brands->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $brand = $this->Brands->patchEntity($brand, $this->request->getData());
            if ($this->Brands->save($brand)) {
            $this->Flash->success(__('La marca fue guardada exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La marca no se pudo guardar, por favor intente nuevamente.'));
        }
        $this->set(compact('brand'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Brand id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['post', 'delete']);
        $brand = $this->Brands->get($id);
        try{
            $this->Brands->delete($brand); 
             $this->Flash->success(__('La marca se ha eliminado exitosamente'));
        } catch (\PDOException $e) {
     $this->Flash->error(__('La marca no se pudo eliminar. Puede deberse a que tiene modelos asociados a ella'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
}

