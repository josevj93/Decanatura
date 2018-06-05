<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssetsTransfersFixture
 *
 */
class AssetsTransfersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'transfers_id' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'assets_id' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'FK_AssetsId' => ['type' => 'index', 'columns' => ['assets_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['transfers_id', 'assets_id'], 'length' => []],
            'FK_AssetsId' => ['type' => 'foreign', 'columns' => ['assets_id'], 'references' => ['assets', 'plaque'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'FK_TransferId' => ['type' => 'foreign', 'columns' => ['transfers_id'], 'references' => ['transfers', 'transfers_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'transfers_id' => '8adce641-4809-4bf0-8180-c2b684f4ed3d',
            'assets_id' => '80800482-7f26-4319-9b67-1f21a588cb72'
        ],
    ];
}
