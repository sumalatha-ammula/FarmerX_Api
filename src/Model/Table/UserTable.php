<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Model
 *
 * @property \App\Model\Table\CropTable&\Cake\ORM\Association\HasMany $Crop
 * @property \App\Model\Table\UserModuleSubscriptionTable&\Cake\ORM\Association\HasMany $UserModuleSubscription
 * @property \App\Model\Table\ModulesTable&\Cake\ORM\Association\BelongsToMany $Modules
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UserTable extends Table
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

        $this->setTable('user');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Crop', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('UserModuleSubscription', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsToMany('Modules', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'module_id',
            'joinTable' => 'user_modules',
        ]);
        $this->belongsTo('Modules', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER',
      ]);

      $this->hasMany('Crop', [
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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->requirePresence('phone', 'create')
            ->notEmptyString('phone');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('profile_img')
            ->maxLength('profile_img', 255)
            ->allowEmptyFile('profile_img');

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
