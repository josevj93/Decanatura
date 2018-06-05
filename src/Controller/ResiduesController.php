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

        //obtengo la tabla assets
        $assets = TableRegistry::get('Assets');
        //busco los datos que necesito
        $query = $assets->find()
                        ->select(['Assets.plaque'])
                        ->where(['Assets.residues_id'=>$id])
                        ->toList();
        //lo paso a objeto
        $size = count($query);
        $result = array_fill(0, $size, NULL);
        
        for($i = 0; $i < $size; $i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }

        //obtengo la tabla technical_reports
        $technical_reports = TableRegistry::get('TechnicalReports');
        //busco los datos que necesito
        $query2 = $technical_reports->find()
                                    ->select(['TechnicalReports.recommendation', 'TechnicalReports.technical_report_id'])
                                    ->where(['TechnicalReports.residues_id'=>$id])
                                    ->toList();
        //lo paso a objeto
        $size2 = count($query2);
        $result2 = array_fill(0, $size2, NULL);
        
        for($i = 0; $i < $size2; $i++)
        {
            $result2[$i] =(object)$query2[$i]->technical_reports;
        }

        $this->set(compact('residue', 'result', 'result2'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /*
        //$assets = TableRegistry::get('Assets')->find('all');

        $assetsQuery = TableRegistry::get('Assets');
        $assetsQuery = $assetsQuery->find()
                         ->select(['assets.plaque','assets.brand','assets.model','assets.series','assets.state'])
                         ->join([
                            'technical_reports' => [
                                    'table' => 'technical_reports',
                                    'type'  => 'inner',
                                    'condition' => ['assets.plaque = technical_reports.assets_id']
                                ]
                                ])
                         ->where(['technical_reports' => "D"])
                         ->toList();

        $size = count($assetsQuery);
        $asset=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $asset[$i] =(object)$assetsQuery[$i]->assets;
        }
        debug($asset);
        $this->set(compact('residues','asset'));
        */

        $residue = $this->Residues->newEntity();
        if ($this->request->is('post')) {
            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            //debug($residue);
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('The residue has been saved.'));

                /*debug($this->request->getData('Aid')); 
                debug($residue->residues_id); */

                /*$assets = TableRegistry::get('Assets')->find('all');
                //debug($assets);

                $assets->update()
                ->set(['residues_id' => $residue->residues_id])
                ->where(['plaque' => $this->request->getData('Aid')])
                ->execute();*/


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
