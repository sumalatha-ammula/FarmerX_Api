<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IndustryFixture
 */
class IndustryFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'industry';
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
                'name' => 'Lorem ipsum dolor sit amet',
                'icon' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
            ],
        ];
        parent::init();
    }
}
