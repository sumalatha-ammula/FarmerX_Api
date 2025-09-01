<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PaymentsFixture
 */
class PaymentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'order_id' => 'Lorem ipsum dolor sit amet',
                'entity' => 'Lorem ipsum dolor sit amet',
                'amount' => 1,
                'amount_paid' => 1,
                'amount_due' => 1,
                'currency' => 'Lorem ip',
                'receipt' => 'Lorem ipsum dolor sit amet',
                'offer_id' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor ',
                'attempts' => 1,
                'created_at' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'payment_response' => 'Lorem ipsum dolor sit amet',
                'signature' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
