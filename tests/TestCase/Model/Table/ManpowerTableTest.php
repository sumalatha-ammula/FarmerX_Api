<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManpowerTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManpowerTable Test Case
 */
class ManpowerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ManpowerTable
     */
    protected $Manpower;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Manpower',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Manpower') ? [] : ['className' => ManpowerTable::class];
        $this->Manpower = $this->getTableLocator()->get('Manpower', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Manpower);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ManpowerTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
