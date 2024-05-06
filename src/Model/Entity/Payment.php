<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property string|null $order_id
 * @property string $entity
 * @property float $amount
 * @property float $amount_paid
 * @property float $amount_due
 * @property string $currency
 * @property string $receipt
 * @property string|null $offer_id
 * @property string $status
 * @property int|null $attempts
 * @property string $created_at
 * @property string $description
 * @property string|null $payment_response
 * @property string|null $signature
 *
 * @property \App\Model\Entity\Payment[] $payments
 */
class Payment extends Entity
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
        'order_id' => true,
        'entity' => true,
        'amount' => true,
        'amount_paid' => true,
        'amount_due' => true,
        'currency' => true,
        'receipt' => true,
        'offer_id' => true,
        'status' => true,
        'attempts' => true,
        'created_at' => true,
        'description' => true,
        'payment_response' => true,
        'signature' => true,
        'payments' => true,
    ];
}
