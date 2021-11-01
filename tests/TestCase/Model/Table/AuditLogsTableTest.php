<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AuditLogsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AuditLogsTable Test Case
 */
class AuditLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AuditLogsTable
     */
    protected $AuditLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AuditLogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AuditLogs') ? [] : ['className' => AuditLogsTable::class];
        $this->AuditLogs = TableRegistry::getTableLocator()->get('AuditLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AuditLogs);

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
}
