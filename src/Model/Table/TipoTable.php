<?php
namespace App\Model\Table;
use Cake\Validation\Validator;

use Cake\ORM\Table;

class TipoTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
    
      public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('id_tipo')
            ->notEmpty('nombre')
            ->notEmpty('descripcion');

        return $validator;
    }
}