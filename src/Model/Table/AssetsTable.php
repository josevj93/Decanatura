<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Assets Model
 *
 * @property \App\Model\Table\TypesTable|\Cake\ORM\Association\BelongsTo $Types
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\LocationsTable|\Cake\ORM\Association\BelongsTo $Locations
 *
 * @method \App\Model\Entity\Asset get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asset newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asset[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asset|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asset patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asset[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asset findOrCreate($search, callable $callback = null, $options = [])
 */
class AssetsTable extends Table
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

        $this->setTable('assets');
        $this->setDisplayField('plaque');
        $this->setPrimaryKey('plaque');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'image' => [
                'fields' => [
                    'dir' => 'image_dir',
                    'size' => 'image_size',
                    'type' => 'image_type',
                ],
                'path' => 'webroot{DS}files{DS}{model}{DS}{field}{DS}{field-value:unique_id}{DS}',
            ],
        ]);

        $this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'owner_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'responsable_id'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
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
            ->scalar('plaque')
            ->maxLength('plaque', 255)
            ->notEmpty('plaque');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->allowEmpty('brand');

        $validator
            ->scalar('model')
            ->maxLength('model', 255)
            ->allowEmpty('model');

        $validator
            ->scalar('series')
            ->maxLength('series', 255)
            ->allowEmpty('series');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmpty('description');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->allowEmpty('state');

        $validator
            ->maxLength('image', 255)
            ->allowEmpty('image');

        $validator
            ->scalar('sub_location')
            ->maxLength('sub_location', 255)
            ->allowEmpty('sub_location');

        $validator
            ->integer('year')
            ->allowEmpty('year');

        $validator
            ->boolean('lendable')
            ->requirePresence('lendable', 'create')
            ->notEmpty('lendable');

        $validator
            ->scalar('observations')
            ->maxLength('observations', 4294967295)
            ->allowEmpty('observations');

        $validator
            ->scalar('image_dir')
            ->maxLength('image_dir', 255)
            ->allowEmpty('image_dir');

        $validator
            ->scalar('unique_id')
            ->maxLength('unique_id', 255)
            ->notEmpty('unique_id');

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
        $rules->add($rules->existsIn(['type_id'], 'Types'));
        $rules->add($rules->existsIn(['owner_id'], 'Users'));
        $rules->add($rules->existsIn(['responsable_id'], 'Users'));
        $rules->add($rules->existsIn(['location_id'], 'Locations'));

        return $rules;
    }
}
