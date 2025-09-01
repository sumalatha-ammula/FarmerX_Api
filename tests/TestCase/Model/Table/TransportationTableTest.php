<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransportationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransportationTable Test Case
 */
class TransportationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TransportationTable
     */
    protected $Transportation;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Transportation',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Transportation') ? [] : ['className' => TransportationTable::class];
        $this->Transportation = $this->getTableLocator()->get('Transportation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Transportation);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TransportationTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
