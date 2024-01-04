<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Crop Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $category
 * @property string $name
 * @property string $photo
 * @property string $description
 * @property \Cake\I18n\FrozenTime|null $start_date
 * @property string|null $qty
 * @property string|null $quality
 * @property string $price
 * @property string|null $location
 * @property string $address
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $created_by
 * @property bool $status
 *
 * @property \App\Model\Entity\CropImage[] $crop_images
 */
class Crop extends Entity
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
        'category' => true,
        'name' => true,
        'photo' => true,
        'description' => true,
        'start_date' => true,
        'qty' => true,
        'quality' => true,
        'price' => true,
        'location' => true,
        'address' => true,
        'created_on' => true,
        'created_by' => true,
        'status' => true,
        'crop_images' => true,
    ];
}
