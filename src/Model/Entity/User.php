<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string|null $profile_img
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property bool $status
 *
 * @property \App\Model\Entity\Crop[] $crop
 * @property \App\Model\Entity\UserModuleSubscription[] $user_module_subscription
 * @property \App\Model\Entity\Module[] $modules
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'email' => true,
        'phone' => true,
        'password' => true,
        'profile_img' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
        'crop' => true,
        'user_module_subscription' => true,
        'modules' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
}
