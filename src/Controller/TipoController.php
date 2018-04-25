<?php
namespace App\Controller;

class TipoController extends AppController
{
     public $components = ['Flash'];

    public function index()
    {
         $this->set('tipos', $this->Tipo->find('all'));
    }

    public function view($id = null)
    {
        $tipo = $this->Tipo->get($id_tipo);
        $this->set(compact('tipo'));
    }
    
    
    public function add()
    {
        $tipo = $this->Tipo->newEntity();
        if ($this->request->is('post')) {
            $tipo = $this->Tipo->patchEntity($tipo, $this->request->getData());
            if ($this->Tipo->save($tipo)) {
                $this->Flash->success(__('Your tipo has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your tipo.'));
        }
        $this->set('tipo', $tipo);
    }
    
    public function edit($id = null)
{
    $tipo = $this->Tipo->get($id_tipo);
    if ($this->request->is(['post', 'put'])) {
        $this->Tipo->patchEntity($tipo, $this->request->getData());
        if ($this->Tipo->save($tipo)) {
            $this->Flash->success(__('Tu artículo ha sido actualizado.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
    }

    $this->set('tipo', $tipo);
}
    public function delete($id)
{
    $this->request->allowMethod(['post', 'delete']);

    $tipo = $this->Tipo->get($id_tipo);
    if ($this->Tipo->delete($tipo)) {
        $this->Flash->success(__('El artículo con id: {0} ha sido eliminado.', h($id_tipo)));
        return $this->redirect(['action' => 'index']);
    }
}
}