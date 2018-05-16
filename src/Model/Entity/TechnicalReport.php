<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TechnicalReport Entity
 *
 * @property int $technical_report_id
<<<<<<< HEAD
 * @property \Cake\I18n\FrozenDate $date
 * @property string $assets_id
 * @property string $evaluation
 * @property string $recommendation
 * @property string|resource $document
=======
 * @property string $assets_id
 * @property string $evaluation
 * @property string $recommendation
 * @property \Cake\I18n\FrozenDate $date
 * @property string $file_name
 * @property string $path
 * @property string $residues_id
>>>>>>> origin/Develop
 *
 * @property \App\Model\Entity\Asset $asset
 */
class TechnicalReport extends Entity
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
<<<<<<< HEAD
        'date' => true,
        'assets_id' => true,
        'evaluation' => true,
        'recommendation' => true,
        'document' => true,
=======
        'assets_id' => true,
        'evaluation' => true,
        'recommendation' => true,
        'date' => true,
        'file_name' => true,
        'path' => true,
        'residues_id' => true,
>>>>>>> origin/Develop
        'asset' => true
    ];
}
