<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TechnicalReports Model
 *
 * @property \App\Model\Table\AssetsTable|\Cake\ORM\Association\BelongsTo $Assets
<<<<<<< HEAD
=======
 * @property |\Cake\ORM\Association\BelongsTo $Residues
>>>>>>> origin/Develop
 *
 * @method \App\Model\Entity\TechnicalReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\TechnicalReport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TechnicalReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalReport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TechnicalReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalReport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalReport findOrCreate($search, callable $callback = null, $options = [])
 */
class TechnicalReportsTable extends Table
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

        $this->setTable('technical_reports');
        $this->setDisplayField('technical_report_id');
        $this->setPrimaryKey('technical_report_id');

        $this->belongsTo('Assets', [
            'foreignKey' => 'assets_id',
            'joinType' => 'INNER'
        ]);
<<<<<<< HEAD
=======
        $this->belongsTo('Residues', [
            'foreignKey' => 'residues_id'
        ]);
>>>>>>> origin/Develop
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
            ->integer('technical_report_id')
<<<<<<< HEAD
            ->notEmpty('tecnical_report_id')
            ->requirePresence('location_id', 'create');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');
=======
            ->allowEmpty('technical_report_id', 'create');
>>>>>>> origin/Develop

        $validator
            ->scalar('evaluation')
            ->maxLength('evaluation', 500)
            ->requirePresence('evaluation', 'create')
            ->notEmpty('evaluation');

        $validator
            ->scalar('recommendation')
            ->maxLength('recommendation', 1)
            ->requirePresence('recommendation', 'create')
            ->notEmpty('recommendation');

        $validator
<<<<<<< HEAD
            ->allowEmpty('document');
=======
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');


        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 200)
            ->allowEmpty('file_name');

        $validator
            ->scalar('path')
            ->maxLength('path', 200)
            ->allowEmpty('path');
>>>>>>> origin/Develop

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
        $rules->add($rules->existsIn(['assets_id'], 'Assets'));
<<<<<<< HEAD
=======
        $rules->add($rules->existsIn(['residues_id'], 'Residues'));
>>>>>>> origin/Develop

        return $rules;
    }
}
