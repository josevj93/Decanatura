<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Login Controller
 *
 *
 * @method \App\Model\Entity\Login[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LoginController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
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


    public function isAuthorized($user)
    {

        // Admin can access every action
        if (true) {
            return true;
        }

        // Default deny
        return false;
    }



}
