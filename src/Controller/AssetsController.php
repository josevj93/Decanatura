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
}