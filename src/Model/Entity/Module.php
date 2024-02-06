<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Module Entity
 *
 * @property int $id
 * @property string $name
 * @property string $subscription_type
 * @property int $expiry
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property bool|null $status
 *
 * @property \App\Model\Entity\UserModuleSubscription[] $user_module_subscription
 * @property \App\Model\Entity\User[] $user
 */
class Module extends Entity
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
        'subscription_type' => true,
        'expiry' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
        'user_module_subscription' => true,
        'user' => true,
    ];
}
