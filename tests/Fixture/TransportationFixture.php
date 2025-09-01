<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransportationFixture
 */
class TransportationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'transportation';
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
                'user_id' => 1,
                'transport_category' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'photo' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'start_date' => 1710136859,
                'capacity' => 'Lorem ipsum dolor sit amet',
                'price_km' => 'Lorem ipsum dolor sit amet',
                'contact_number' => 'Lorem ipsum dolor sit amet',
                'service_area' => 'Lorem ipsum dolor sit amet',
                'created_on' => 1710136859,
                'created_by' => 1,
                'status' => 1,
            ],
        ];
        parent::init();
    }
}
