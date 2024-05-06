<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payments Model
 *
 * @method \App\Model\Entity\Payment newEmptyEntity()
 * @method \App\Model\Entity\Payment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Payment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Payment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Payment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Payment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PaymentsTable extends Table
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

        $this->setTable('payments');
        $this->setDisplayField('entity');
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
            ->scalar('order_id')
            ->maxLength('order_id', 200)
            ->allowEmptyString('order_id');

        $validator
            ->scalar('entity')
            ->maxLength('entity', 100)
            ->requirePresence('entity', 'create')
            ->notEmptyString('entity');

        $validator
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        $validator
            ->numeric('amount_paid')
            ->requirePresence('amount_paid', 'create')
            ->notEmptyString('amount_paid');

        $validator
            ->numeric('amount_due')
            ->requirePresence('amount_due', 'create')
            ->notEmptyString('amount_due');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 10)
            ->requirePresence('currency', 'create')
            ->notEmptyString('currency');

        $validator
            ->scalar('receipt')
            ->maxLength('receipt', 100)
            ->requirePresence('receipt', 'create')
            ->notEmptyString('receipt');

        $validator
            ->scalar('offer_id')
            ->maxLength('offer_id', 100)
            ->allowEmptyString('offer_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 20)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->integer('attempts')
            ->allowEmptyString('attempts');

        $validator
            ->scalar('created_at')
            ->maxLength('created_at', 100)
            ->requirePresence('created_at', 'create')
            ->notEmptyString('created_at');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('payment_response')
            ->maxLength('payment_response', 200)
            ->allowEmptyString('payment_response');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 200)
            ->allowEmptyString('signature');

        return $validator;
    }
}
