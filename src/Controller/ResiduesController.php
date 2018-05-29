<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

/**
 * Residues Controller
 *
 * @property \App\Model\Table\ResiduesTable $Residues
 *
 * @method \App\Model\Entity\Residue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResiduesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $residues = $this->paginate($this->Residues);

        $this->set(compact('residues'));
    }

    /**
     * View method
     *
     * @param string|null $id Residue id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $residue = $this->Residues->get($id, [
            'contain' => []
        ]);

        $this->set('residue', $residue);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $residue = $this->Residues->newEntity();
        if ($this->request->is('post')) {
            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('The residue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The residue could not be saved. Please, try again.'));
        }
        $this->set(compact('residue'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Residue id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $residue = $this->Residues->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('The residue has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The residue could not be saved. Please, try again.'));
        }
        $this->set(compact('residue'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Residue id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    //borra la referencia en assets(activos) y borra el acta de desecho con el id enviado
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $assets = TableRegistry::get('Assets')->find()->where(['residues_id' => $id]);
        
        $assets->update()
        ->set(['residues_id' => null])
        ->where(['residues_id' => $id])
        ->execute();

        $residue = $this->Residues->get($id);
        debug($this->Residues->get($id));
        if ($this->Residues->delete($residue)) {
            $this->Flash->success(__('The residue has been deleted.'));
        } else {
            $this->Flash->error(__('The residue could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search()
    {
        $id= $_GET['id'];
        $assets = TableRegistry::get('Assets');
        $searchedAsset= $assets->get($id);
        if(empty($searchedAsset) )
        {
            throw new NotFoundException(__('Activo no encontrado') );      
        }
        $this->set('serchedAsset',$searchedAsset);
    }
}
