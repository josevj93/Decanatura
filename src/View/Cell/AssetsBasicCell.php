<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * AssetsBasic cell
 */
class AssetsBasicCell extends Cell
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
    public function display($plaque= null)
    { 
        $AssetBuscado= plaque;
        if(plaque == null)
        {
            $Assets = TableRegistry::get('Assets');
            $AssetBuscado= $Assets->find(plaque)
                              ->select(['brand','model','series','description']);
            $this->set(compact( 'AssetBuscado'));
        }
        $this->set(compact( 'AssetBuscado'));        
    }
}
