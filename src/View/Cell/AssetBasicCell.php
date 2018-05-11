<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * AssetBasic cell
 */
class AssetBasicCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($plaque)
    {
        $this->loadModel('Assets');
        $assetBasic = $this->Assets->find($plaque);
        echo $assetBasic;
        $this->set(compact('assetBasic'));
    }
}
