<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transfer Entity
 *
 * @property string $transfers_id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $Acade_Unit_recib
 * @property string $functionary
 * @property string $identification
 *
 * @property \App\Model\Entity\Asset[] $assets
 */
class Transfer extends Entity
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
        'date' => true,
        'Acade_Unit_recib' => true,
        'functionary' => true,
        'identification' => true,
        'assets' => true
    ];
}
