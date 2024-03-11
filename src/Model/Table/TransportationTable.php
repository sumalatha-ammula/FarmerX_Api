<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Transportation Model
 *
 * @method \App\Model\Entity\Transportation newEmptyEntity()
 * @method \App\Model\Entity\Transportation newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Transportation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transportation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transportation findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Transportation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transportation[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transportation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transportation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transportation[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transportation[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transportation[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Transportation[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TransportationTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('transportation');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->integer('transport_category')
            ->requirePresence('transport_category', 'create')
            ->notEmptyString('transport_category');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('photo')
            ->maxLength('photo', 255)
            ->requirePresence('photo', 'create')
            ->notEmptyString('photo');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->dateTime('start_date')
            ->allowEmptyDateTime('start_date');

        $validator
            ->scalar('capacity')
            ->maxLength('capacity', 100)
            ->requirePresence('capacity', 'create')
            ->notEmptyString('capacity');

        $validator
            ->scalar('price_km')
            ->maxLength('price_km', 100)
            ->requirePresence('price_km', 'create')
            ->notEmptyString('price_km');

        $validator
            ->scalar('contact_number')
            ->maxLength('contact_number', 100)
            ->requirePresence('contact_number', 'create')
            ->notEmptyString('contact_number');

        $validator
            ->scalar('service_area')
            ->maxLength('service_area', 200)
            ->requirePresence('service_area', 'create')
            ->notEmptyString('service_area');

        $validator
            ->dateTime('created_on')
            ->notEmptyDateTime('created_on');

        $validator
            ->integer('created_by')
            ->notEmptyString('created_by');

        $validator
            ->boolean('status')
            ->notEmptyString('status');

        return $validator;
    }
}
