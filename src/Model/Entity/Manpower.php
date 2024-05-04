<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Manpower Entity
 *
 * @property int $id
 * @property string $jobtitle
 * @property string $name
 * @property string $phone
 * @property string $location
 * @property string $skills
 * @property int $expectedsalary
 * @property int $is_hired
 * @property int|null $hired_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property \Cake\I18n\FrozenDate $hired_on
 * @property \Cake\I18n\FrozenDate $expiry_on
 * @property int $noofdays
 * @property \Cake\I18n\FrozenTime|null $subscription_expiry
 */
class Manpower extends Entity
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
        'jobtitle' => true,
        'name' => true,
        'phone' => true,
        'location' => true,
        'skills' => true,
        'expectedsalary' => true,
        'is_hired' => true,
        'hired_by' => true,
        'created_on' => true,
        'hired_on' => true,
        'expiry_on' => true,
        'noofdays' => true,
        'subscription_expiry' => true,
    ];
}
