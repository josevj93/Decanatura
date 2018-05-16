<?php
namespace App\Controller;

use App\Controller\AppController;
<<<<<<< HEAD

/**
 * Assets Controller
 *
 * @property \App\Model\Table\AssetsTable $Assets
 *
 * @method \App\Model\Entity\Asset[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
=======
use Imagine;

/**
* Controlador para los activos de la aplicación
*/
>>>>>>> origin/Develop
class AssetsController extends AppController
{

    /**
<<<<<<< HEAD
     * Index method
     *
     * @return \Cake\Http\Response|void
=======
     * Método para desplegar una lista con un resumen de los datos de activos
>>>>>>> origin/Develop
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
<<<<<<< HEAD
     * View method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
=======
     * Método para ver los datos completos de un activo
>>>>>>> origin/Develop
     */
    public function view($id = null)
    {
        $asset = $this->Assets->get($id, [
            'contain' => ['Types', 'Users', 'Locations']
        ]);

        $this->set('asset', $asset);
    }

    /**
<<<<<<< HEAD
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
=======
     * Método para agregar nuevos activos al sistema
>>>>>>> origin/Develop
     */
    public function add()
    {
        $asset = $this->Assets->newEntity();
        if ($this->request->is('post')) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
            if ($this->Assets->save($asset)) {
<<<<<<< HEAD
                $this->Flash->success(__('El activo fue guardado'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, porfavor intente nuevamente'));
        }
=======


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

>>>>>>> origin/Develop
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }

    /**
<<<<<<< HEAD
     * Edit method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
=======
     * Método para editar un activo en el sistema
>>>>>>> origin/Develop
     */
    public function edit($id = null)
    {
        $asset = $this->Assets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asset = $this->Assets->patchEntity($asset, $this->request->getData());
<<<<<<< HEAD
            if ($this->Assets->save($asset)) {
                $this->Flash->success(__('El activo fue guardado con exito'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, porfavor intente nuevamente'));
=======
            
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

                $this->Flash->success(__('El activo fue guardado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El activo no se pudo guardar, por favor intente nuevamente.'));
>>>>>>> origin/Develop
        }
        $types = $this->Assets->Types->find('list', ['limit' => 200]);
        $users = $this->Assets->Users->find('list', ['limit' => 200]);
        $locations = $this->Assets->Locations->find('list', ['limit' => 200]);
        $this->set(compact('asset', 'types', 'users', 'locations'));
    }

    /**
<<<<<<< HEAD
     * Delete method
     *
     * @param string|null $id Asset id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
=======
     * Método para eliminar un activo del sistema
>>>>>>> origin/Develop
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asset = $this->Assets->get($id);
        if ($this->Assets->delete($asset)) {
<<<<<<< HEAD
            $this->Flash->success(__('El activo fue borrado con exito'));
        } else {
            $this->Flash->error(__('El activo no se pudo borrar, porfavor intente nuevamente'));
=======
            $this->Flash->success(__('El activo fue borrado exitosamente.'));
        } else {
            $this->Flash->error(__('El activo no se pudo borrar, por favor intente nuevamente.'));
>>>>>>> origin/Develop
        }

        return $this->redirect(['action' => 'index']);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> origin/Develop
