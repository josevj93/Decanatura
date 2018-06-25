<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Residues Model
 *
 * @method \App\Model\Entity\Residue get($primaryKey, $options = [])
 * @method \App\Model\Entity\Residue newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Residue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Residue|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Residue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Residue[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Residue findOrCreate($search, callable $callback = null, $options = [])
 */
class ResiduesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('residues');
        $this->setDisplayField('residues_id');
        $this->setPrimaryKey('residues_id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('residues_id')
            ->maxLength('residues_id', 200)
            ->notEmpty('residues_id', 'El número de autorización es requerido.')
            ->alphaNumeric('residues_id', 'El número de autorización sólo debe contener caracteres alfanuméricos.');

        $validator
            ->scalar('name1')
            ->maxLength('name1', 50)
            ->requirePresence('name1', 'create')
            ->add('name1',[ 
                [
                'rule'=>['custom', ' /^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/ '],
                'message'=>'Debe contener sólo caracteres del alfabeto.'
                ]
            ])
            ->notEmpty('name1','Este campo es requerido.');

        $validator
            ->scalar('identification1')
            ->maxLength('identification1', 9)
            ->requirePresence('identification1', 'create')
            ->add('identification2', [
                [
                'rule' => ['numElements', 'equal', 9],
                'message' => 'La cédula debe tener 9 dígitos',
                ]
            ])
            ->notEmpty('identification1','Este campo es requerido');

        $validator
            ->scalar('name2')
            ->maxLength('name2', 50)
            ->requirePresence('name2', 'create')
            ->ascii('name2','Debe contener sólo caracteres del alfabeto')
            ->notEmpty('name2','Este campo es requerido');

        $validator
            ->scalar('identification2')
            //->numElements('identification2', 'equal',9)
            ->requirePresence('identification2', 'create')
            ->add('identification2', [
                [
                'rule' => ['numElements', 'not equal', 9],
                'message' => 'La cédula debe tener 9 dígitos',
                ]
            ])
            ->notEmpty('identification2','Este campo es requerido');

        $validator
            ->date('date','dmy', 'Formato de fecha no válido.')
            ->notEmpty('date','Este campo es requerido');

        $validator
            ->boolean('descargado')
            ->allowEmpty('descargado');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 100)
            ->allowEmpty('file_name');

        $validator
            ->scalar('path')
            ->maxLength('path', 100)
            ->allowEmpty('path');

        return $validator;
    }
}
