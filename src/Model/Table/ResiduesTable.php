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
            ->notEmpty('residues_id', 'create');

        $validator
            ->scalar('name1')
            ->maxLength('name1', 50)
            ->requirePresence('name1', 'create')
            ->notEmpty('name1');

        $validator
            ->scalar('identification1')
            ->maxLength('identification1', 10)
            ->requirePresence('identification1', 'create')
            ->notEmpty('identification1');

        $validator
            ->scalar('name2')
            ->maxLength('name2', 50)
            ->requirePresence('name2', 'create')
            ->notEmpty('name2');

        $validator
            ->scalar('identification2')
            ->maxLength('identification2', 10)
            ->requirePresence('identification2', 'create')
            ->notEmpty('identification2');

        $validator
            ->date('date')
            ->notEmpty('date');

        return $validator;
    }
}
