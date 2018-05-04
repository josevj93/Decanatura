<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido1
 * @property string $apellido2
 * @property string $correo
 * @property string $username
 * @property string $password
 * @property int $id_rol
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nombre' => true,
        'apellido1' => true,
        'apellido2' => true,
        'correo' => true,
        'username' => true,
        'password' => true,
        'id_rol' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password){
        return (new DefaultPasswordHasher)->hash($password);
    }

/*
    protected function _setPassword($password){
        if(strlen($password) > 0){
            return (new DefalutPasswordHasher)->hash($password);
        }
    }

*/
}
