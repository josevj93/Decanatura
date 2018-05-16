<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
<<<<<<< HEAD
=======
@property \App\Model\Table\PermissionsTable $Permissions
>>>>>>> origin/Develop
 *
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

<<<<<<< HEAD
=======
    public function initialize(){
        $this->Permissions = $this->loadModel('Permissions');
        $this->RolesPermissions = $this->loadModel('RolesPermissions');

    }

>>>>>>> origin/Develop
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
<<<<<<< HEAD
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
=======



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

                $rol_activo = $id;

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
                $checks = $this->request->data;

                $rol_activo = (int)$this->request->data['activo'];
                //BORRA LAS TUPLAS DE PERMISOS PARA EL ROL

                $this->RolesPermissions->deleteAll(
                    array(
                        "RolesPermissions.id_rol" => $rol_activo
                    )
                );

                for($i=1;$i<21;$i++){
                    if($checks[$i] == 1){
                        //INSERTA
                        $permiso = $this->RolesPermissions->newEntity();

                        $permiso->id_rol = $rol_activo;
                        $permiso->id_permission = $i;

                        if ($this->RolesPermissions->save($permiso)) {
                            //$this->Flash->success(__('The roles permission has been saved.'));
                        }else{
                            //$this->Flash->error(__('The roles permission could not be saved. Please, try again.'));
                        }




                    }
                }



            }

        }else{
            //CARGA SIN POST


            $id = 1;
            $rol_activo = 1;

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



        }

        $this->set('permisos',$permisos);

        $this->set('rol_activo',$rol_activo);
>>>>>>> origin/Develop
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
<<<<<<< HEAD
}
=======





}
>>>>>>> origin/Develop
