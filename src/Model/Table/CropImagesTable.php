<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CropImages Model
 *
 * @method \App\Model\Entity\CropImage newEmptyEntity()
 * @method \App\Model\Entity\CropImage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\CropImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CropImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\CropImage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\CropImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CropImage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CropImage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CropImage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CropImage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CropImage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\CropImage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\CropImage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CropImagesTable extends Table
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

        $this->setTable('crop_images');
        $this->setDisplayField('location');
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
            ->integer('crop_id')
            ->requirePresence('crop_id', 'create')
            ->notEmptyString('crop_id');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->requirePresence('location', 'create')
            ->notEmptyString('location');

        $validator
            ->dateTime('uploaded_on')
            ->notEmptyDateTime('uploaded_on');

        return $validator;
    }
}
