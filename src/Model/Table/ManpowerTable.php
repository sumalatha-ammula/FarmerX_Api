<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Manpower Model
 *
 * @method \App\Model\Entity\Manpower newEmptyEntity()
 * @method \App\Model\Entity\Manpower newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Manpower[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Manpower get($primaryKey, $options = [])
 * @method \App\Model\Entity\Manpower findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Manpower patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Manpower[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Manpower|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manpower saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Manpower[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manpower[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manpower[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Manpower[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ManpowerTable extends Table
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

        $this->setTable('manpower');
        $this->setDisplayField('jobtitle');
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
            ->scalar('jobtitle')
            ->maxLength('jobtitle', 200)
            ->requirePresence('jobtitle', 'create')
            ->notEmptyString('jobtitle');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('phone')
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->scalar('skills')
            ->maxLength('skills', 255)
            ->requirePresence('skills', 'create')
            ->notEmptyString('skills');

        $validator
            ->integer('expectedsalary')
            ->requirePresence('expectedsalary', 'create')
            ->notEmptyString('expectedsalary');

        $validator
            ->requirePresence('is_hired', 'create')
            ->notEmptyString('is_hired');

        $validator
            ->scalar('hired_by')
            ->maxLength('hired_by', 255)
            ->allowEmptyString('hired_by');

        $validator
            ->dateTime('created_on')
            ->notEmptyDateTime('created_on');

        $validator
            ->date('hired_on')
            ->requirePresence('hired_on', 'create')
            ->notEmptyDate('hired_on');

        $validator
            ->date('expiry_on')
            ->requirePresence('expiry_on', 'create')
            ->notEmptyDate('expiry_on');

        return $validator;
    }
}
