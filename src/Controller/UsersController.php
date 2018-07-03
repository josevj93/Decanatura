<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;
use Cake\Datasource\ConnectionManager;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        //$this->Auth->deny('users/index');
        //$this->Auth->allow(['add']);

       /* $userId = $this->Auth->user('id');
        if($userId == 102){
            $this->Auth->deny('add');
        }
    */
       
    }

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
        $this->viewBuilder()->setLayout('default');


        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('default');


        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $query = $this->Roles->find('all', array(
                    'conditions' => array(
                        'id' => $user['id_rol']
                    )
                ));

        $rol = '';

        foreach ($query as $items) {
            $rol = $items['nombre'];
        }

        $this->set('rol', $rol);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        $query = $this->Roles->find('all');
        $roles = array();
        foreach ($query as $items) {
            $roles[$items['id']] = $items['nombre'];
        }
        $this->set('roles', $roles);
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {

                //print_r( $this->name );
                AppController::insertLog($user['nombre']);





                //die();

                /*$user_action = '';
                if ($this->request->getParam('action') == 'add'){
                    $user_action = 'Agregar';
                }else if($this->request->getParam('action') == 'edit'){
                    $user_action = 'Modificar';
                }else if($this->request->getParam('action') == 'delete'){
                    $user_action = 'Eliminar';
                }
                $session = $this->request->getSession();
                $current_user = $session->read('Auth.User');
                $dateAndTime = date("Y-m-d H:i:s");
                $conn = ConnectionManager::get('default');
                $stmt = $conn->execute('INSERT INTO activity_logs (DateAndTime,idUser,userAction,message) values(\'' . $dateAndTime . '\', \'' . $current_user['id'] . '\', \'' . $user_action . '\', \'se ha insertado el usuario ' . $user['nombre'] . '\');');
*/

                /* $myData = $this->ActivityLogs;
                 $myData['DateAndTime'] = $dateAndTime;
                 $myData['idUser'] = $user['id'];
                 $myData['userAction'] = 'insertar';
                 $myData['message'] = 'se ha insertado el usuario' .$current_user['nombre'];
                 $this->al->save($myData);*/

                $this->Flash->success(__('El usuario ha sido agregado.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no pudo ser agregado, intente nuevamente'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        //seleccina todos los roles para desplegar
        $query = $this->Roles->find('all');

        //contiene todos los roles
        $roles = array();

        //id del rol actual del usuario
        $rol = '';

        foreach ($query as $items) {
            $roles[$items['id']] = $items['nombre'];
            if($items['id'] == $user['id_rol']){
                $rol = $items['id'];
            }
        }

        $this->set('roles', $roles);
        $this->set('rol', $rol);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Cambios guardados.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Los cambios no pudieron ser guardados. Por favor vuelva a intentarlo.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido borrado.'));
        } else {
            $this->Flash->error(__('El usuario no pudo ser borrado, intente nuevamente'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login(){

     $this->viewBuilder()->setLayout('login');

     if($this->request->is('post')){
        $user = $this->Auth->identify();
        if($user){
            $this->Auth->setUser($user);
            return $this->redirect('/');
        }
        $this->Flash->error(__('Usuario o contaseña inválidos, intente otra vez'));
        }
    }

    public function logout(){
        return $this->redirect($this->Auth->logout());
    }
}