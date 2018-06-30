<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ActivityLogs Controller
 *
 * @property \App\Model\Table\ActivityLogsTable $ActivityLogs
 *
 * @method \App\Model\Entity\ActivityLog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityLogsController extends AppController
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
        $this->paginate = [
            'contain' => ['Users']
        ];
        $activityLogs = $this->paginate($this->ActivityLogs);

        $this->set(compact('activityLogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityLog = $this->ActivityLogs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('activityLog', $activityLog);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityLog = $this->ActivityLogs->newEntity();
        if ($this->request->is('post')) {
            $activityLog = $this->ActivityLogs->patchEntity($activityLog, $this->request->getData());
            if ($this->ActivityLogs->save($activityLog)) {
                $this->Flash->success(__('The activity log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity log could not be saved. Please, try again.'));
        }
        $users = $this->ActivityLogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('activityLog', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityLog = $this->ActivityLogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityLog = $this->ActivityLogs->patchEntity($activityLog, $this->request->getData());
            if ($this->ActivityLogs->save($activityLog)) {
                $this->Flash->success(__('The activity log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity log could not be saved. Please, try again.'));
        }
        $users = $this->ActivityLogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('activityLog', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity Log id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityLog = $this->ActivityLogs->get($id);
        if ($this->ActivityLogs->delete($activityLog)) {
            $this->Flash->success(__('The activity log has been deleted.'));
        } else {
            $this->Flash->error(__('The activity log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
