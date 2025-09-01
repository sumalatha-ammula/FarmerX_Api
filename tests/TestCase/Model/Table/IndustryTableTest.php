<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IndustryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IndustryTable Test Case
 */
class IndustryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IndustryTable
     */
    protected $Industry;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Industry',
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
        $config = $this->getTableLocator()->exists('Industry') ? [] : ['className' => IndustryTable::class];
        $this->Industry = $this->getTableLocator()->get('Industry', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Industry);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IndustryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
