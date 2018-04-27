<?php
namespace App\Model\Table;
use Cake\Validation\Validator;

use Cake\ORM\Table;

class TypesTable extends Table
{
    public function initialize(array $config)
    {

    }
    
      public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('type_id');

        return $validator;
    }
}