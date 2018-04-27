<?php
namespace App\Controller;

class TypesController extends AppController
{
     public $components = ['Flash'];

    public function index()
    {
         $this->set('types', $this->Types->find('all'));
    }

    public function view($id = null)
    {
        $type = $this->Types->get($type_id);
        $this->set(compact('type'));
    }
    
    
    public function add()
    {
        $type = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $type = $this->Types->patchEntity($type, $this->request->getData());
            if ($this->Types->save($type)) {
                $this->Flash->success(__('Your type has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your type.'));
        }
        $this->set('type', $type);
    }
    
    public function edit($id = null)
{
    $type = $this->Types->get($id_type);
    if ($this->request->is(['post', 'put'])) {
        $this->Types->patchEntity($type, $this->request->getData());
        if ($this->Types->save($type)) {
            $this->Flash->success(__('Tu artículo ha sido actualizado.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
    }

    $this->set('type', $type);
}
    public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);

    $type = $this->Types->get($id_type);
    if ($this->Types->delete($type)) {
        $this->Flash->success(__('El artículo con id: {0} ha sido eliminado.', h($id_type)));
        return $this->redirect(['action' => 'index']);
    }
}
}