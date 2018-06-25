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
        $technical_reports = TableRegistry::get('TechnicalReports');
        $assetsQuery = $technical_reports->find()
                         ->select(['assets.plaque','assets.brand','assets.model','assets.series','assets.state'])
                         ->join([
                            'assets' => [
                                    'table' => 'assets',
                                    'type'  => 'INNER',
                                    'conditions' => ['assets.plaque= TechnicalReports.assets_id']
                                ]
                                ])
                         ->where(['TechnicalReports.recommendation' => "D"])
                         ->group (['assets.plaque'])
                         ->toList();

        $size = count($assetsQuery);
        $result=   array_fill(0, $size, NULL);
        
        for($i=0;$i<$size;$i++)
        {
            $result[$i] =(object)$assetsQuery[$i]->assets;
        }
        $this->set(compact('residues','result'));
        
        $residue = $this->Residues->newEntity();
        if ($this->request->is('post')) {
            $residue = $this->Residues->patchEntity($residue, $this->request->getData());
            if ($this->Residues->save($residue)) {
                $this->Flash->success(__('The residue has been saved.'));

                $condicion = explode(',', $this->request->getData('checkList'));
                
                $assets = TableRegistry::get('Assets')->find('all');
                $assets->update()
                    ->set(['residues_id' => $residue->residues_id])
                    ->where(['plaque IN' => $condicion])
                    ->execute();

                $technical_reports = TableRegistry::get('TechnicalReports')->find('all');
                $technical_reports->update()
                    ->set(['residues_id' => $residue->residues_id])
                    ->where(['assets_id IN' => $condicion])
                    ->execute();
                
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
                                ->set(['residues_id' => NULL])
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
                                ->set(['residues_id' => $residue->residues_id])
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



    public function download($id = null)
    {


        $residue = $this->Residues->get($id);

        //$residue['id']                    Autorizacion
        //$residue['date']                  Fecha
        //$residue['name1']                 Nombre1
        //$residue['identification1']       Cedula1
        //$residue['name2']                 Nombre2
        //$residue['identification2']       Cedula2


        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT * FROM assets
            inner join residues on residues_id = id
            where id =\'' . $id . '\';');

        $results = $stmt ->fetchAll('assoc');



         require_once 'dompdf/autoload.inc.php';
        //initialize dompdf class
        $document = new Dompdf();
        $html = 
        '
        <style>
        #element1 {float:left;margin-right:10px;} #element2 {float:right;} 
        table, td, th {
            border: 1px solid black;
        }
        body {
            border: 5px double;
            width:100%;
            height:100%;
            display:block;
            overflow:hidden;
            padding:30px 30px 30px 30px
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            height: 50px;
        }
        </style>


<p><strong><sup>&nbsp;</sup></strong></p>
<h2 align="center">Universidad de Costa Rica</h2>
<h2 align="center">Vicerrector&iacute;a de Administraci&oacute;n</h2>
<h2 align="center">Oficina de Administraci&oacute;n Financiera</h2>
<p align="center">Unidad de Control de Activos Fijos y Seguros</p>
<p align="center"><strong>***Tel. 207-5045 / 2075759 ** Fax 253-4630***</strong></p>
<h2 align="center">ACTA DE DESECHO</h2>
<h1>&nbsp;</h1>
<div id="element1" align="left">  Fecha: __________________ </div> <div id="element2" align="right"> No.__________________ </div> 
<p align="right">(Lo asigna el usuario)</p>
<p><strong>&nbsp;</strong></p>

<table>
  <tr>
    <th align="center"><span style="font-weight:bold">ENTREGA</span></th>
    <th align="center"><span style="font-weight:bold">RECIBE</span></th>
  </tr>
  <tr>
    <td height="50"><strong>Unidad: Decanato de la Facultad Ingenieria&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td height="50"><strong>Unidad:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
  </tr>
  <tr>
    <td height="50"><strong>Nombre del Funcionario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td height="50"><strong>Nombre del Funcionario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
  </tr>
  <tr>
    <td height="75"><strong>Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td height="75"><strong>Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
  </tr>
</table>

<h2 align="center">Detalle de los bienes a trasladar</h2>
<table width="0" border="1">
<tbody>
<tr>
<th align="center">Descripcion del Bien</th>
<th align="center">Placa</th>
</tr>';

        foreach ($results as $item) {
            $html .= 
            '<tr>
            <td align="center">' . $item['description'] . '</td>
             <td align="center">' . $item['plaque'] . '</td>
             </tr>';
        }


$html .=

'</table>
<br><br><br>
<p><strong>Observaciones: </strong></p>
<p><strong>Nota: El formulario debe estar firmado por el encargado de activos fijos u otro funcionario autorizado en cada unidad.</strong></p>
<p><strong>Original: Oficina de Administraci&oacute;n Financiera&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copia: Unidad que entrega&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copia: Unidad que recibe</strong></p>
        ';


        $document->loadHtml($html);

        //set page size and orientation
        $document->setPaper('A3', 'portrait');
        //Render the HTML as PDF
        $document->render();
        //Get output of generated pdf in Browser
        $document->stream("Acta de Desecho", array("Attachment"=>1));
        //1  = Download
        //0 = Preview
        return $this->redirect(['action' => 'index']);

    }


}
