<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
//use Cake\ORM\Query;

/**
 * Residues Controller
 *
 * @property \App\Model\Table\ResiduesTable $Residues
 *
 * @method \App\Model\Entity\Residue[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResiduesController extends AppController
{
    private $UnidadAcadémica = 'Ingeniería';
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
        $residue = $this->Residues->get($id);

        //obtengo la tabla assets
        $assets = TableRegistry::get('Assets');
        //busco los datos que necesito
        $assetsquery = $assets->find()
                        ->select(['assets.plaque'])
                        ->where(['residues_id'=>$id])
                        ->toList();

        //lo paso a objeto para manejarlo en vista
        $size = count($assetsquery);
        $result = array_fill(0, $size, NULL);
        
        for($i = 0; $i < $size; $i++)
        {
            $result[$i] =(object)$assetsquery[$i]->assets;
        }

       
        //obtengo la tabla technical_reports
        $technical_reports = TableRegistry::get('TechnicalReports');
        //busco los datos que necesito
        $queryRec = $technical_reports->find()
                                    ->select(['recommendation', 'technical_report_id'])
                                    ->where(['residues_id'=>$id])
                                    ->toList();

        //lo paso a objeto
        $size = count($queryRec);
        $resultRec = array_fill(0, $size, NULL);
       // debug($queryRec);
        for($i = 0; $i < $size; $i++)
        {
            $resultRec[$i] =(object)$queryRec[$i];
        }

        $Unidad = $this->UnidadAcadémica;

        $this->set(compact('residue', 'result', 'resultRec', 'Unidad'));

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
        $residue = $this->Residues->get($id);

        $technical_reports = TableRegistry::get('TechnicalReports');

        $query = $technical_reports->find()
                        ->select(['assets.plaque', 'assets.brand', 'assets.model', 'assets.series', 'assets.state'])
                        ->join ([
                            'assets'=> [
                                'table'=>'assets',
                                'type'=>'INNER',
                                'conditions'=> ['assets.plaque= TechnicalReports.assets_id']
                            ]
                        ])
                        ->where(['TechnicalReports.recommendation' => "D"])
                        ->group(['assets.plaque'])
                        ->toList();

        $size = count($query);

        $result = array_fill(0, $size, NULL);
        
        for($i = 0; $i < $size; $i++)
        {
            $result[$i] =(object)$query[$i]->assets;
        }

        $Unidad = $this->UnidadAcadémica;



        if ($this->request->is(['patch', 'post', 'put'])) {
            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('El acta de residuo ha sido guardada'));


                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El acta de residuo no se ha guradado, intentalo de nuevo'));

        }

        $assets = TableRegistry::get('Assets');

        $query2 = $assets->find()
                        ->select(['assets.plaque'])
                        ->where(['assets.residues_id' => $id])
                        ->toList();

        $size = count($query2);

        $result2 = array_fill(0, $size, NULL);
        
        for($i = 0; $i < $size; $i++)
        {
            $result2[$i] =(object)$query2[$i]->assets;
        }

        $this->set(compact('residue', 'result', 'result2', 'Unidad'));
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
