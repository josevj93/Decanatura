<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
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
            $random = uniqid();
            $fecha = date('Y-m-d H:i:s');
            $asset->created = $fecha;
            $asset->modified = $fecha;
            $asset->unique_id = $random;
            $asset->deletable = true;
            $asset->deleted = false;
            $asset->state = "Disponible";
            $asset = $this->Assets->patchEntity($asset, $this->request->getData()); 
            if ($this->Assets->save($asset)) {
                $this->Assets->addThumbnail($asset);
                
                $this->Flash->success(__('El activo fue guardado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, por favor intente nuevamente.'));
        }
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        
        
        $brands = array(); 
        $this->paginate = [
            'contain' => ['Types', 'Users', 'Locations']
        ];
        $assets = $this->paginate($this->Assets);
        foreach ($assets as $filterBrand) {
            if (!in_array($filterBrand->brand, $brands)){
                array_push($brands, $filterBrand->brand);
            }
        }
        
        $this->set(compact('asset', 'types', 'users', 'locations', 'brands', 'assets'));
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
            $fecha = date('Y-m-d H:i:s');
            $asset->modified = $fecha;
            
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
                if($asset->image != NULL){
                    $this->Assets->addThumbnail();
                }
                $this->Flash->success(__('El activo fue guardado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, por favor intente nuevamente.'));
        }
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }
    /**
     * Elimina solo logicamente los activos de la base de datos
     * 
     * @param asset
     * @return 0 - archivo no se eliminó correctamente, 1 - hard delete completado, 2 - soft delete completado
     */
    public function softDelete($plaque){
        $asset = $this->Assets->get($plaque);
        
        if($asset->deletable){
            if($this->Assets->delete($asset)){
                return 1;
            }
            return 0;
        }
        
        $fecha = date('Y-m-d H:i:s');
        $asset->deleted = true;
        $asset->state = 'Desactivado';
        $asset->modified = $fecha;
        
        if ($this->Assets->save($asset)) {
            return 2;
        }
        return 0;
    }
    /**
     * Método para eliminar un activo del sistema
     */
    public function delete($asset)
    {
        if ($this->Assets->delete($asset)) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public static function storeModel($activos = null, $marca = null)
    {   
        $models = array(); 
        //$marca = "Apple";
       
        foreach ($activos as $filterModel) {
            if ($filterModel->brand == $marca && !in_array($filterModel->model, $models)){
                array_push($models, $filterModel->model);
            }
        }
        return $models;
        
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
            $series = $this->request->getData('series');
            $listaSeries = preg_split("/(, )| /", $series, -1);
            //parseo la placa con letras para dividirla en predicado+numero (asg21fa34)
            //divide con una expresion regular: (\d*)$
            //pregunta si hay letras en la placa
            if (preg_match("/([a-z])\w+/", $placa)){
                list($predicado, $numero) = preg_split("/(\d*)$/", $placa, NULL ,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
            }
            //$predicado = asg21fa
            //$numero = 34
            //realiza el ciclo
            for ($i = 0; $i < $cantidad; $i++){
                $asset = $this->Assets->newEntity();
                if (array_key_exists($i, $listaSeries)){
                        $serie = $listaSeries[$i];
                    } else{
                        $serie = null;
                    }
                if(!preg_match("/([a-z])\w+/", $placa)){
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
                        'lendable' => $prestable,
                        'series' => $serie
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
                        'lendable' => $prestable,
                        'series' => $serie
                    ];
                    $numero = $numero + 1;
                }
                
                $asset = $this->Assets->patchEntity($asset, $data);
                //meter una por una a la base
                $this->Assets->save($asset);
                //incrementa la placa
                //$numero = $numero + 1
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
