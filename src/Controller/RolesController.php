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

        $permisos = array();

        for ($i = 1; $i < 25; ++$i) {
            $permisos[$i] = 0;
        }

        

        $roles = $this->Roles->find('all');

        $roles_names = array(); 

        foreach ($roles as $item) {
            $roles_names[] = $item['nombre'];
        
        } 
        

        $this->set('roles',$roles_names);

       

        if ($this->request->is('post')) {
            
                //return $this->redirect(['action' => 'index']);


            $accion = (int)$this->request->data['accion'];


            if($accion == 1){
                //CONSULTA LOS PERMISOS DEL ROL SELECCIONADO
                $id = (int)$this->request->data['rol'];
                $id = $id + 1;


                $query = $this->Roles->find('all', array(
                    'conditions' => array(
                        'id' => $id
                    )
                ))->contain(['Permissions']);;

                foreach ($query as $roles) {
                    $rls = $roles['permissions'];
                    foreach ($rls as $item){
                        $permisos[(int)$item['id']] = 1;
                        //echo $item['id'];
                        //echo "<br>";
                    }
                } 


                //aqui termina if         
            }else if($accion == 2){
                //GUARDA LOS ROLES SEGUN LA MATRIZ DE CHECKBOX



            }

        }

        $this->set('permisos',$permisos);
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

*/


            $query = $this->Roles->find('all', array(
                'conditions' => array(
                    'id' => $id
                )
            ))->contain(['Permissions']);;







            //find('all')->contain(['Roles']);


            foreach ($query as $roles) {
                $rls = $roles['permissions'];
                foreach ($rls as $item){
                    echo $item['nombre'];
                    echo "<br>";
                }
            }            

            //exit;
/*
            $datos = $rol->toArray(); 

            foreach($datos as $var){

                pr($var['id_permission']);

            }
            

            exit;


*/
        }


    }


    public function guardar(){
        
        if($this->request->is('post')){
            $myarray = $this->request->data['desechos'];
            pr($myarray);

            exit;
        }


    }



}