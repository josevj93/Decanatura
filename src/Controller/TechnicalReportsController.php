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
        //Saco el ultimo id y le sumo 1
        $tmpId= $this->TechnicalReports->find('all',['fields'=>'technical_report_id'])->last();
        $tmpId= $tmpId->technical_report_id+1;

        $assets = $this->TechnicalReports->Assets->find('list', ['limit' => 200]);
        $this->set(compact('technicalReport', 'assets','tmpId'));

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
        <title>Informe Técnico</title>
        <body style="margin-left:100">
        <h2><center>
        UNIVERSIDAD DE COSTA RICA
        <br>
        UNIDAD DE BIENES INSTITUCIONALES
        <br>
        INFORME TÉCNICO</center><h2>

        <table style="width:35%">
        <tr>
        <th><h3>Unidad custodio:'.$technicalReport->asset->responsable_id.'<h3></th>
        <th><h3>Fecha:'.$technicalReport->date.'<h3></th>
        </tr>
        <tr>
        <th><br><h3>Evaluación del activo:'.$technicalReport->recommendation.'<h3></th>
        </tr>
        <tr>
        <th><h3><br>N° Placa:'.$technicalReport->asset->plaque.'<h3></th>
        <th><h3>Modelo:'.$technicalReport->asset->model.'<h3></th>
        </tr>
        <tr>
        <th><h3>Marca:'.$technicalReport->asset->brand.'<h3></th>
        <th><h3>Serie:'.$technicalReport->asset->series.'<h3></th>
        </tr>
        <tr>
        <th><h3><br>Evualuación del activo:'.$technicalReport->evaluation.'<h3></th>
        </tr>
        </table>
        <table style="width:100%">
        <th>
        <h3>Técnico Especializado<h3>
        <h4>Nombre___________________<h4>
        <h4>Firma____________________<h4>
        </th>
        <th>
        <h3>Responsable de bienes de la Unidad Custodio<h3>
        <h4>Nombre___________________<h4>
        <h4>Firma____________________<h4>
        </th>
        <th>
        <h3>Responsable de bienes de la Unidad Custodio<h3>
        <h4>Nombre___________________<h4>
        <h4>Firma____________________<h4>
        </th>
        </table>
        </body>
        </html>
        ');

        //set page size and orientation
        $document->setPaper('A3', 'landscape');
        //Render the HTML as PDF
        $document->render();
        //Get output of generated pdf in Browser
        $document->stream("Informe técnico", array("Attachment"=>1));
        //1  = Download
        //0 = Preview
        return $this->redirect(['action' => 'index']);

    }

}
