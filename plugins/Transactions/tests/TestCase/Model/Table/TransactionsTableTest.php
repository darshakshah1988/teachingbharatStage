<?php
declare(strict_types=1);

namespace Transactions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Transactions\Model\Table\TransactionsTable;

/**
 * Transactions\Model\Table\TransactionsTable Test Case
 */
class TransactionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Transactions\Model\Table\TransactionsTable
     */
    protected $Transactions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Transactions.Transactions',
        'plugin.Transactions.Users',
        'plugin.Transactions.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Transactions') ? [] : ['className' => TransactionsTable::class];
        $this->Transactions = $this->getTableLocator()->get('Transactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Transactions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
