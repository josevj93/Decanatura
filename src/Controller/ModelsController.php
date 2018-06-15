<?php
namespace App\Controller;
use App\Controller\AppController;
/**
 * Models Controller
 *
 * @property \App\Model\Table\ModelsTable $Models
 *
 * @method \App\Model\Entity\Model[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModelsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->paginate = [
            'contain' => ['Brands', 'Types']
        ];
        $models = $this->paginate($this->Models);
        $this->set(compact('models'));
    }
    /**
     * View method
     *
     * @param string|null $id Model id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $model = $this->Models->get($id, [
            'contain' => ['Brands', 'Types']
        ]);
        $this->set('model', $model);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $model = $this->Models->newEntity();
        if ($this->request->is('post')) {
			
			$random = uniqid();
            $model->id = $random;
            $model = $this->Models->patchEntity($model, $this->request->getData());
            if ($this->Models->save($model)) {
                $this->Flash->success(__('El modelo fue guardado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El modelo no se pudo guardar, por favor intente nuevamente.'));
        }
		
		$brands = $this->Models->Brands->find('list', ['limit' => 200]);
		$types = $this->Models->Types->find('list', ['limit' => 200]);
        $this->set(compact('model', 'brands', 'types'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Model id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $model = $this->Models->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $model = $this->Models->patchEntity($model, $this->request->getData());
            if ($this->Models->save($model)) {
                $this->Flash->success(__('El modelo fue guardado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El modelo no se pudo guardar, por favor intente nuevamente.'));
        }
        
		$brands = $this->Models->Brands->find('list', ['limit' => 200]);
		$types = $this->Models->Types->find('list', ['limit' => 200]);
        $this->set(compact('model', 'brands', 'types'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Model id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $model = $this->Models->get($id);
        if ($this->Models->delete($model)) {
            $this->Flash->success(__('The model has been deleted.'));
        } else {
            $this->Flash->error(__('The model could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}