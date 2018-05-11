<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * TechnicalReports Controller
 *
 * @property \App\Model\Table\TechnicalReportsTable $TechnicalReports
 *
 * @method \App\Model\Entity\TechnicalReport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TechnicalReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
        $technicalReports = $this->paginate($this->TechnicalReports);

        $this->set(compact('technicalReports'));
    }

    /**
     * View method
     *
     * @param string|null $id Technical Report id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $technicalReport = $this->TechnicalReports->get($id, [
            'contain' => ['Assets']
        ]);

        $this->set('technicalReport', $technicalReport);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $technicalReport = $this->TechnicalReports->newEntity();
        if ($this->request->is('post')) {
            $technicalReport = $this->TechnicalReports->patchEntity($technicalReport, $this->request->getData());
            if ($this->TechnicalReports->save($technicalReport)) {
                $this->Flash->success(__('The technical report has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el reporte.'));
        }
        $assets = $this->TechnicalReports->Assets->find('list', ['limit' => 200]);
        $this->set(compact('technicalReport', 'assets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Technical Report id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $technicalReport = $this->TechnicalReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $technicalReport = $this->TechnicalReports->patchEntity($technicalReport, $this->request->getData());
            if ($this->TechnicalReports->save($technicalReport)) {
                $this->Flash->success(__('The technical report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The technical report could not be saved. Please, try again.'));
        }
        $assets = $this->TechnicalReports->Assets->find('list', ['limit' => 200]);
        $this->set(compact('technicalReport', 'assets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Technical Report id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $technicalReport = $this->TechnicalReports->get($id);
        if ($this->TechnicalReports->delete($technicalReport)) {
            $this->Flash->success(__('The technical report has been deleted.'));
        } else {
            $this->Flash->error(__('The technical report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function searchAsset()
    {   
        $this->loadComponent('RequestHandler');
         $this->autoRender = false;
        /*if($placa!=null)
        {   
            $assets = TableRegistry::get('Assets');
           
            $assetSearch= $Assets->find('list',['conditions'=>['plaque ='=>$placa] ])
                                  ->select(['brand','model','series','description']);
            $asset= $assetSearch;
            echo "<label>Placa</label>";
            echo $asset->plaque;
        }*/
        if($this->RequestHandler->isAjax()) 
        {       
                $now = new Time();
                $resultJ = json_encode(array('result' => array('now' => $now)));
                $this->response->type('json');
                $this->response->body($resultJ);

                return $this->response;
        }   
    }

    public function search()
    {
        $id= $_GET['id'];
        $assets = TableRegistry::get('Assets');
        $assetSearch= $assets->get('640');
        $this->set('assetSerched',$assetSearch);
    
    }
}
