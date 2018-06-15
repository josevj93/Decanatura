<?php
namespace App\Controller;

use App\Controller\AppController;
use Imagine;

/**
* Controlador para los activos de la aplicación
*/
class AssetsController extends AppController
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
                if($item['nombre'] == 'Insertar Activos'){
                    $allowI = true;
                }else if($item['nombre'] == 'Modificar Activos'){
                    $allowM = true;
                }else if($item['nombre'] == 'Eliminar Activos'){
                    $allowE = true;
                }else if($item['nombre'] == 'Consultar Activos'){
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
     * Método para desplegar una lista con un resumen de los datos de activos
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Types', 'Users', 'Locations']
        ];
        $assets = $this->paginate($this->Assets);

        $this->set(compact('assets'));
    }

    /**
     * Método para ver los datos completos de un activo
     */
    public function view($id = null)
    {
        $asset = $this->Assets->get($id, [
            'contain' => ['Types', 'Users', 'Locations']
        ]);

        $this->set('asset', $asset);
    }

    /**
     * Método para agregar nuevos activos al sistema
     */
    public function add()
    {
        $asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {


                /*Si el archivo tiene imagen, crea un thumbnail*/
                if(!strlen($asset->image_dir) == 0){
                    $imagine = new Imagine\Gd\Imagine();

                    $size    = new Imagine\Image\Box(640, 640);

                    $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                    $imagine->open('../webroot/files/Assets/image/' .  $asset->unique_id . '/' . $asset->image)
                            ->thumbnail($size, $mode)
                            ->save('../webroot/files/Assets/image/' . $asset->unique_id . '/' . 'thumbnail.png');
                }

                $this->Flash->success(__('El activo fue guardado'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, porfavor intente nuevamente'));
        }

        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }

    /**
     * Método para editar un activo en el sistema
     */
    public function edit($id = null)
    {
        $asset = $this->Assets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());

            if ($this->Assets->save($asset)) {
            /*

                if(!strlen($asset->image_dir) == 0){
                    $imagine = new Imagine\Gd\Imagine();

                    $size    = new Imagine\Image\Box(640, 640);

                    $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                    $imagine->open('../webroot/files/Assets/image/' .  $asset->unique_id . '/' . $asset->image)
                            ->thumbnail($size, $mode)
                            ->save('../webroot/files/Assets/image/' . $asset->unique_id . '/' . 'thumbnail.png');
                }*/

                $this->Flash->success(__('El activo fue guardado con exito'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, porfavor intente nuevamente'));
        }
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }

    /**
     * Método para eliminar un activo del sistema
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
            $this->Flash->success(__('El activo fue borrado con exito'));
        } else {
            $this->Flash->error(__('El activo no se pudo borrar, porfavor intente nuevamente'));
        }

        return $this->redirect(['action' => 'index']);
    }

    
    /**
     * Método para agregar activos por lotes
     */
    public function batch($cantidad = null)
    {
        $asset = $this->Assets->newEntity();
        //$asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            //guarda en variables todos los campos reutilizables
            $cantidad = $this->request->getData('quantity');
            $placa = $this->request->getData('plaque');
            $tipo = $this->request->getData('type_id');
            $marca = $this->request->getData('brand');
            $modelo = $this->request->getData('model');
            $estado = $this->request->getData('state');
            $descripcion = $this->request->getData('description');
            $dueno = $this->request->getData('owner_id');
            $responsable = $this->request->getData('responsable_id');
            $ubicacion = $this->request->getData('location_id');
            $año = $this->request->getData('year');
            $prestable = $this->request->getData('lendable');
            //parseo la placa con letras para dividirla en predicado+numero (asg21fa34)
            //divide con una expresion regular: (\d*)$
            list($predicado, $numero) = preg_split("/(\d*)$/", $placa);
            echo($predicado);
            echo($numero);
            //$predicado = asg21fa
            //$numero = 34
            //realiza el ciclo
            for ($i = 0; $i < $cantidad; $i++){
                $asset = $this->Assets->newEntity();
                if($predicado == null){
                    $data = [
                        'plaque' => $placa,
                        'type_id' => $tipo,
                        'brand' => $marca,
                        'model' => $modelo,
                        'state' => $estado,
                        'description' => $descripcion,
                        'owner_id' => $dueno,
                        'responsable_id' => $responsable,
                        'location_id' => $ubicacion, 
                        'year' => $año,
                        'lendable' => $prestable
                    ];
                    $placa = $placa + 1;
                }
                else{ //agrego predicado+numero como placa
                    $data = [
                        'plaque' => $predicado . $numero,
                        'type_id' => $tipo,
                        'brand' => $marca,
                        'model' => $modelo,
                        'state' => $estado,
                        'description' => $descripcion,
                        'owner_id' => $dueno,
                        'responsable_id' => $responsable,
                        'location_id' => $ubicacion, 
                        'year' => $año,
                        'lendable' => $prestable
                    ];
                    $numero = $numero + 1;
                }
                
                $asset = $this->Assets->patchEntity($asset, $data);
                //meter una por una a la base
                $this->Assets->save($asset);
                //incrementa la placa
                //$numero = $numero + 1
                /**if($i == 1){
                    echo($asset);
                    die();
                }*/
            }
            $this->Flash->success(__('Los activos fueron guardados'));
            return $this->redirect(['action' => 'index']);
        }
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }
}

