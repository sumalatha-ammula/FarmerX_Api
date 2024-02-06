<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CropImage Entity
 *
 * @property int $id
 * @property int $crop_id
 * @property string $location
 * @property \Cake\I18n\FrozenTime $uploaded_on
 */
class CropImage extends Entity
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
        'crop_id' => true,
        'location' => true,
        'uploaded_on' => true,
    ];
}
