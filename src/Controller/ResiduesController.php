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

    public function isAuthorized($user)
    {

        $this->Roles = $this->loadModel('Roles');
        $this->Permissions = $this->loadModel('Permissions');
        $this->RolesPermissions = $this->loadModel('RolesPermissions');

        $allowI = false;
        $allowM = false;
        $allowE = false;
        $allowC = false;
        
        $query = $this->Roles->find('all', array(
                    'conditions' => array(
                        'id' => $user['id_rol']
                    )
                ))->contain(['Permissions']);

        foreach ($query as $roles) {
            $rls = $roles['permissions'];
            foreach ($rls as $item){
                //$permisos[(int)$item['id']] = 1;
                if($item['nombre'] == 'Insertar Usuarios'){
                    $allowI = true;
                }else if($item['nombre'] == 'Modificar Usuarios'){
                    $allowM = true;
                }else if($item['nombre'] == 'Eliminar Usuarios'){
                    $allowE = true;
                }else if($item['nombre'] == 'Consultar Usuarios'){
                    $allowC = true;
                }
            }
        } 


        $this->set('allowI',$allowI);
        $this->set('allowM',$allowM);
        $this->set('allowE',$allowE);
        $this->set('allowC',$allowC);


        if ($this->request->getParam('action') == 'add'){
            return $allowI;
        }else if($this->request->getParam('action') == 'edit'){
            return $allowM;
        }else if($this->request->getParam('action') == 'delete'){
            return $allowE;
        }else if($this->request->getParam('action') == 'view'){
            return $allowC;
        }else{
            return $allowC;
        }


    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $residues = $this->paginate($this->Residues);
        /*
                
        $residues = TableRegistry::get('residues');

            $indexQuery = $residues->find()
                ->select(['residues.residues_id','max(residues.date)','technical_reports.recommendation '])
                //select residues.residues_id, max(residues.date),technical_reports.date, technical_reports.recommendation 
                //inner join assets on assets.residues_id = residues.residues_id
                ->join([
                            'assets' => [
                                    'table' => 'assets',
                                    'type'  => 'INNER',
                                    'conditions' => ['assets.residues_id = residues.residues_id']
                                ]
                                ])
                //inner join technical_reports on technical_reports.assets_id = assets.plaque
                ->join([
                        'technical_reports' => [
                                    'table' => 'technical_reports',
                                    'type'  => 'INNER',
                                    'conditions' => ['assets.plaque= TechnicalReports.assets_id']
                                ]
                                ])
                ->where(['residues.residues_id' => '1'])
                ->toList();
                


                debug($indexQuery);
                exit();   
                */        
        $Unidad = $this->UnidadAcadémica;
        $this->set(compact('residues','Unidad'));
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
                                    ->group(['assets_id'])
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

            $residue = $this->Residues->patchEntity($residue, $this->request->getData(),['validationDefault'=>'residues_id']);
            
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('El acta de desecho fue guardada.'));

                $condicion = explode(',', $this->request->getData('checkList'));
                
                $assets = TableRegistry::get('Assets')->find('all');
                $assets->update()
                    ->set(['residues_id' => $residue->residues_id, 'state' => "Desechado"])
                    ->where(['plaque IN' => $condicion])
                    ->execute();

                $technical_reports = TableRegistry::get('TechnicalReports')->find('all');
                $technical_reports->update()
                    ->set(['residues_id' => $residue->residues_id])
                    ->where(['assets_id IN' => $condicion])
                    ->execute();
                
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Acta de Desecho no se pudo guardar. Intentolo de nuevo.'));
        }


        $technical_reports = TableRegistry::get('TechnicalReports');
        $assetsQuery = $technical_reports->find()
                         ->select(['assets.plaque','brands.name','models.name','assets.series','assets.state'])
                         ->join([
                            'assets' => [
                                    'table' => 'assets',
                                    'type'  => 'LEFT',
                                    'conditions' => ['assets.plaque= TechnicalReports.assets_id']
                                ]
                                ])
                         ->join([
                            'models' => [
                                    'table' => 'models',
                                    'type'  => 'LEFT',
                                    'conditions' => ['assets.models_id= models.id']
                                ]
                                ])
                         ->join([
                            'brands' => [
                                    'table' => 'brands',
                                    'type'  => 'LEFT',
                                    'conditions' => ['models.id_brand = brands.id']
                                ]
                                ])
                         ->where(['TechnicalReports.recommendation' => "D"])
                         //->where(['assets.state !='=>'Desechado'])
                         ->group (['assets.plaque'])
                         ->toList();

        $size = count($assetsQuery);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$assetsQuery[$i]->assets;
        }
        $this->set(compact('residue', 'result'));
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

        $assets = TableRegistry::get('Assets');

        //Obtengo los activos que estan en el acta de residuos
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


        if ($this->request->is(['patch', 'post', 'put'])) { 

            //saco la lista de placas señaladas y luego las paso a Array
            $check = $this->request->getData("checkList");
            $checksViejos = explode(",", $check);

            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('El acta de residuo ha sido guardada'));

                //AQUI EMPIEZA LA MAGIA

                $tmp = array_fill(0, $size, NULL);

                $i = 0;

                foreach ($result2 as $res) {

                    $tmp[$i] = $res -> plaque;
                    $i++;
                }

                $nuevos = array_diff($checksViejos, $tmp);
                $viejos = array_diff($tmp, $checksViejos);

                if (count($viejos) > 0) {

                        $assets = TableRegistry::get('Assets')->find('all');

                        $assets->update()
                                ->set(['residues_id' => NULL, 'state' => "Disponible"])
                                ->where(['plaque IN' => $viejos])
                                ->execute();

                        $technical_reports = TableRegistry::get('TechnicalReports')->find('all');

                        $technical_reports->update()
                                            ->set(['residues_id' => NULL])
                                            ->where(['assets_id IN' => $viejos])
                                            ->execute();
                }

                 if (count($nuevos) > 0) {

                         $assets = TableRegistry::get('Assets')->find('all');
                        
                         $assets->update()
                                ->set(['residues_id' => $residue->residues_id, 'state' => "Desechado"])
                                ->where(['plaque IN' => $nuevos])
                                ->execute();

                         $technical_reports = TableRegistry::get('TechnicalReports')->find('all');

                         $technical_reports->update()
                                             ->set(['residues_id' => $residue->residues_id])
                                             ->where(['assets_id IN' => $nuevos])
                                             ->execute();
                 }

                return $this->redirect(['action' => 'index']);
            }


            $this->Flash->error(__('El acta de residuo no se ha guradado, intentalo de nuevo'));

        }


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
        //se actualiza el estado del activo en la tabla de activos
        $assets->update()
        ->set(['residues_id' => null, 'state' => "Disponible"])
        ->where(['residues_id' => $id])
        ->execute();
        $residue = $this->Residues->get($id);
        //se quita la llave foránea para poder borrar el activo.
        $technical_reports = TableRegistry::get('TechnicalReports')->find('all');

                         $technical_reports->update()
                                             ->set(['residues_id' => null])
                                             ->where(['residues_id' => $residue->residues_id])
                                             ->execute();
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

    public function download($id = null)
    {

        $residue = $this->Residues->get($id, [
            'contain' => ['Assets']
        ]);

        // linea para marcar el desecho como descargado, haciendo que ya no se pueda borrar
        $residue->descargado = true;

        // Actualizo el desecho, guardando el valor de descargado como true
        $this->Residues->save($residue);

        return $this->redirect(['action' => 'index']);
    }
}
