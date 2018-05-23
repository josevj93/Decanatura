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
    /*Fix para no tener que estar autenticado*/
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['add']);
        $this->Auth->allow(['edit']);
        $this->Auth->allow(['index']);
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
                if(!strlen($asset->image_dir) == 0){
                    $imagine = new Imagine\Gd\Imagine();

                    $size    = new Imagine\Image\Box(640, 640);

                    $mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;

                    $imagine->open('../webroot/files/Assets/image/' .  $asset->unique_id . '/' . $asset->image)
                            ->thumbnail($size, $mode)
                            ->save('../webroot/files/Assets/image/' . $asset->unique_id . '/' . 'thumbnail.png');
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
     * Método para eliminar un activo del sistema
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
            $this->Flash->success(__('El activo fue borrado exitosamente.'));
        } else {
            $this->Flash->error(__('El activo no se pudo borrar, por favor intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
