<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManpowerFixture
 */
class ManpowerFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'manpower';
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
                'jobtitle' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'phone' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'location' => 'Lorem ipsum dolor sit amet',
                'skills' => 'Lorem ipsum dolor sit amet',
                'expectedsalary' => 1,
                'is_hired' => 1,
                'hired_by' => 1,
                'created_on' => 1716450395,
                'hired_on' => '2024-05-23',
                'expiry_on' => '2024-05-23',
                'noofdays' => 1,
                'subscription_expiry' => '2024-05-23 07:46:35',
                'industry_id' => 1,
            ],
        ];
        parent::init();
    }
}
