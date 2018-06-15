<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Asset Entity
 *
 * @property string $plaque
 * @property string $type_id
 * @property string $brand
 * @property string $model
 * @property string $series
 * @property string $description
 * @property string $state
 * @property string $image
 * @property int $owner_id
 * @property int $responsable_id
 * @property string $location_id
 * @property string $sub_location
 * @property int $year
 * @property bool $lendable
 * @property string $observations
 * @property string $dir
 *
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Location $location
 */
class Asset extends Entity
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
        'plaque' => true,
        'type_id' => true,
        'brand' => true,
        'model' => true,
        'series' => true,
        'description' => true,
        'state' => true,
        'image' => true,
        'owner_id' => true,
        'responsable_id' => true,
        'location_id' => true,
        'sub_location' => true,
        'year' => true,
        'lendable' => true,
        'observations' => true,
        'image_dir' => true,
        'type' => true,
        'user' => true,
        'location' => true,
        'unique_id' => true
    ];
}

