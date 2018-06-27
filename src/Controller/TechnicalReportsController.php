<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Dompdf\Dompdf;

/**
 * TechnicalReports Controller
 *
 * @property \App\Model\Table\TechnicalReportsTable $TechnicalReports
 *
 * @method \App\Model\Entity\TechnicalReport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TechnicalReportsController extends AppController
{


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
                if($item['nombre'] == 'Insertar Reporte Tecnico'){
                    $allowI = true;
                }else if($item['nombre'] == 'Modificar Reporte Tecnico'){
                    $allowM = true;
                }else if($item['nombre'] == 'Eliminar Reporte Tecnico'){
                    $allowE = true;
                }else if($item['nombre'] == 'Consultar Reporte Tecnico'){
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
        }else if($this->request->getParam('action') == 'view' or $this->request->getParam('action') == 'download'){
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

    // Esta es la variable que se utiliza para generar los reportes
    // Es la sigla de la escuelta que va a utilizar el sistema
    public $escuela = 'INGELEC';
    
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

        //Saco el ultimo id y le sumo 1 para generar el número consecutivo de la base de datos
        $tmpId= $this->TechnicalReports->find('all',['fields'=>'technical_report_id'])->last();
        $tmpId= $tmpId->technical_report_id+1;
        
        // Obtengo el valor para el año actual
        $date = date('Y');

        // Formo el ID completo que se va a desplegar en la vista
        $CompleteID = $this->escuela."-".$tmpId."-".$date;

        // En caso de que la solicitud sea post, o sea, luego de darle aceptar en la vista 
        if ($this->request->is('post')) {
            
            // Obtengo los datos generados desde la vista
            $technicalReport = $this->TechnicalReports->patchEntity($technicalReport, $this->request->getData());

            // Hago las inserciones de las partes adicionales del ID en el reporte tecnico antes de guardarlo
            // Agrego el año actual
            $technicalReport->year = $date;
            // Agrego la sigal de la escuela correspondiente
            $technicalReport->facultyInitials = $this->escuela;

            if ($this->TechnicalReports->save($technicalReport)) {
                $this->Flash->success(__('The technical report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el reporte.'));
        }// if post
        
        // En caso de que la acción sea simplemente cargar la vista
        $assets = $this->TechnicalReports->Assets->find('list', ['limit' => 200]);
        
        // Le paso a la vista los valores de assets y el ID que se va a desplegar.
        $this->set(compact('technicalReport', 'assets','CompleteID'));

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
                $this->Flash->success(__('Los cambios han sido guardados.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El reporte técnico no se pudo guardar.'));
            debug($technicalReport->errors());

        }
        $assets = $this->TechnicalReports->Assets->find('list', ['limit' => 200]);

        //variable para cargar los datos del activo ya asignado
        $assets2= $this->TechnicalReports->Assets->get($technicalReport->assets_id);
        $this->set(compact('technicalReport', 'assets','assets2'));
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

        $technicalReport = $this->TechnicalReports->get($id, [
            'contain' => ['Assets']
        ]);
         require_once 'dompdf/autoload.inc.php';
        //initialize dompdf class
        $document = new Dompdf();
        $html = '';
        $document->loadHtml('
        <html>
        <style>
        #element1 {float:left;margin-right:10px;margin-left:30px;} #element2 {float:right;margin-right:30px;}
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
        <center><img src="C:\xampp\htdocs\Decanatura\src\Controller\images\logoucr.png"></center>
        <title>Informe Técnico</title>
        <h2 align="center">UNIVERSIDAD DE COSTA RICA</h2>
        <h2 align="center">UNIDAD DE ACTIVOS FIJOS</h2>
        <h2 align="center">INFORME TECNICO</h2>
        <p>&nbsp;</p>
        <div id="element1" align="left"><strong>Unidad custodio:</strong>'.$technicalReport->asset->responsable_id.'</div> <div id="element2" align="right"><strong>Fecha:</strong>'.$technicalReport->date.'</div>
        <p>&nbsp;</p>
        <div id="element1" align="left"><strong>Descripción del bien</strong></div>
        <p>&nbsp;</p>
        <div style="width:960px;height:200px;border:1px solid #000;"></div>
        <p>&nbsp;</p>
        <div id="element1" align="left"><strong>N° Placa:&nbsp;</strong>'.$technicalReport->asset->plaque.'</div> <div id="element2" align="right"><strong>Modelo:</strong>&nbsp;'.$technicalReport->asset->models_id.'</div>
        <p>&nbsp;</p>
        <div id="element1" align="left"><strong>Marca:</strong>&nbsp;'.$technicalReport->asset->brand.'</div> <div id="element2" align="right"><strong>Serie:</strong>&nbsp;'.$technicalReport->asset->series.'</div>
        <p>&nbsp;</p>
        <div id="element1" align="left" ><strong>Evaluación del activo:</strong>&nbsp;'.$technicalReport->evaluation.'</div>
        <p>&nbsp;</p>
        <div id="element2" align="right"><strong>¿Cuál?</strong>&nbsp;_____________________</div>
        <p>&nbsp;</p>
        <div id="element1" align="left"><strong>Tecnico Especializado </strong></div> <div id="element2" align="right"><strong>Responsable de bienes de la Unidad Custodio <strong></div>
        <p>&nbsp;</p>
        <div id="element1" align="left">Nombre:&nbsp;___________________________</div> <div id="element2" align="right">Nombre:&nbsp;___________________________</div>
        <p>&nbsp;</p>
        <div id="element1" align="left">Firma:&nbsp;___________________________</div> <div id="element2" align="right">Firma:&nbsp;___________________________</div>
        <p>&nbsp;</p>
        <p align="center"><strong> Autoridad Universitaria</strong></p> 
        <p align="center">Nombre:&nbsp;___________________________</p> 
        <p align="center">Firma:&nbsp;___________________________</p>
        <p>&nbsp;</p>
        <p align="left">Original: Unidad de Bienes Institucionales&nbsp;&nbsp;(OAF)</p>
        <p align="left">Copia: Bodega de Activos Recuperados&nbsp;&nbsp;(OSG)</p>
        <p align="left">Copia: Unidad responsable</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p align="center">Tels: 2511 5759/1149 www.oaf.ucr.ac.cr correo electrónico: activosfijos.oaf@ucr.ac.cr</p>
        ');

        //set page size and orientation
        $document->setPaper('A3', 'portrait');
        //Render the HTML as PDF
        $document->render();
        //Get output of generated pdf in Browser
        $document->stream("Informe Tecnico", array("Attachment"=>1));
        //1  = Download
        //0 = Preview
        return $this->redirect(['action' => 'index']);

    }

}
