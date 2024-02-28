<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OnetimepasswordTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OnetimepasswordTable Test Case
 */
class OnetimepasswordTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OnetimepasswordTable
     */
    protected $Onetimepassword;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Onetimepassword',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Onetimepassword') ? [] : ['className' => OnetimepasswordTable::class];
        $this->Onetimepassword = $this->getTableLocator()->get('Onetimepassword', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Onetimepassword);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\OnetimepasswordTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
