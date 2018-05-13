<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
   @property \App\Model\Table\PermissionsTable $Permissions
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    public function initialize(){
        $this->Permissions = $this->loadModel('Permissions');
        $this->RolesPermissions = $this->loadModel('RolesPermissions');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

        $roles = $this->Roles->find('all',
        array('fields' => array('nombre') ));

        $this->set('roles',$roles);

        $permissions = $this->Permissions->find('all');

        $this->set('permissions',$permissions);

        $rolespermissions = $this->RolesPermissions->find('all');

        $this->set('rolespermissions',$rolespermissions);


        if ($this->request->is('post')) {
            
                return $this->redirect(['action' => 'index']);

        }
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Permissions']
        ]);

        $this->set('role', $role);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $permissions = $this->Roles->Permissions->find('list', ['limit' => 200]);
        $this->set(compact('role', 'permissions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Permissions']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $permissions = $this->Roles->Permissions->find('list', ['limit' => 200]);
        $this->set(compact('role', 'permissions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }




    public function consultar(){
        
        if($this->request->is('post')){
            $id = (int)$this->request->data['rol'];
            $id = $id + 1;
            //$rol = $this->Roles->get($id);
            //pr($rol);
/*
            $rol = $this->Roles->find('list', array(
                'joins' => array(
                    array(
                        'table' => 'RolesPermissions',
                        //'alias' => 'UserJoin',
                        'type' => 'left',
                        'conditions' => array(
                            'Roles.id = RolesPermissions.id_rol'
                        )
                    )
                ),
                'conditions' => array(
                    'Roles.id' => $id
                )//,
                //'fields' => array('Roles.id', 'RolesPermissions.id_rol')
            ));
*/

            $rol = $this->RolesPermissions->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'Permissions',
                        //'alias' => 'UserJoin',
                        'type' => 'INNER',
                        'conditions' => array(
                            'RolesPermissions.id_permission = Permissions.id'
                        )
                    )
                ),
                'conditions' => array(
                    'RolesPermissions.id_rol' => $id
                ),
                'fields' => array('id_permission')
            ));

            

            $datos = $rol->toArray(); 

            foreach($datos as $var){

                pr($var['id_permission']);

            }
            

            //exit;
        }


    }


    public function guardar(){
        
        if($this->request->is('post')){
            $myarray = $this->request->data;
            pr($myarray);

            exit;
        }


    }



}