<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transportation Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $transport_category
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property \Cake\I18n\FrozenTime|null $start_date
 * @property string $capacity
 * @property string $price_km
 * @property string $contact_number
 * @property string $service_area
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property bool $status
 */
class Transportation extends Entity
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
        'user_id' => true,
        'transport_category' => true,
        'name' => true,
        'photo' => true,
        'description' => true,
        'start_date' => true,
        'capacity' => true,
        'price_km' => true,
        'contact_number' => true,
        'service_area' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
    ];
}
