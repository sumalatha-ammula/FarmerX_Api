<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OnetimepasswordFixture
 */
class OnetimepasswordFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'onetimepassword';
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
                'email' => 'Lorem ipsum dolor sit amet',
                'otp' => 'Lorem ipsum dolor sit amet',
                'createdon' => '2024-02-22 07:38:02',
            ],
        ];
        parent::init();
    }
}
