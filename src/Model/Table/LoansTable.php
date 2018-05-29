<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Loans Model
 *
 * @method \App\Model\Entity\Loan get($primaryKey, $options = [])
 * @method \App\Model\Entity\Loan newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Loan[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Loan|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Loan patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Loan[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Loan findOrCreate($search, callable $callback = null, $options = [])
 */
class LoansTable extends Table
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

        $this->setTable('loans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

         $this->belongsTo('Assets', [
            'foreignKey' => 'id_assets',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'id_responsables'
        ]);
        
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
            ->scalar('id')
            ->maxLength('id', 255)
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('id_assets')
            ->maxLength('id_assets', 255)
            ->notEmpty('id_assets');

        $validator
            ->integer('id_responsables')
            ->notEmpty('id_responsables');

        $validator
            ->date('fecha_inicio')
            ->notEmpty('fecha_inicio','Ingrese una fecha de inicio');

        $validator
            ->date('fecha_devolucion')
            ->allowEmpty('fecha_devolucion');

        $validator
            ->scalar('observaciones')
            ->maxLength('observaciones', 4294967295)
            ->allowEmpty('observaciones');

        $validator
            ->scalar('estado')
            ->maxLength('estado', 255)
            ->allowEmpty('estado');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['id_assets'], 'Assets'));
        $rules->add($rules->existsIn(['id_responsables'], 'Users'));
        return $rules;
    }
}
