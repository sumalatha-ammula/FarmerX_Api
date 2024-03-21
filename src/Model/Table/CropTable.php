<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Crop Model
 *
 * @property \App\Model\Table\CropImagesTable&\Cake\ORM\Association\HasMany $CropImages
 *
 * @method \App\Model\Entity\Crop newEmptyEntity()
 * @method \App\Model\Entity\Crop newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Crop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Crop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Crop findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Crop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Crop[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Crop|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Crop saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Crop[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Crop[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Crop[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Crop[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CropTable extends Table
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

        $this->setTable('crop');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('CropImages', [
            'foreignKey' => 'crop_id',
        ]);

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
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
            ->integer('category')
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

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
            ->scalar('qty')
            ->maxLength('qty', 20)
            ->allowEmptyString('qty');

        $validator
            ->scalar('quality')
            ->maxLength('quality', 100)
            ->allowEmptyString('quality');

        $validator
            ->scalar('price')
            ->maxLength('price', 100)
            ->notEmptyString('price');

        $validator
            ->scalar('location')
            ->maxLength('location', 200)
            ->allowEmptyString('location');

        $validator
            ->scalar('address')
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

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
