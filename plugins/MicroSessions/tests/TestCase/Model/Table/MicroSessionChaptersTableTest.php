<?php
declare(strict_types=1);

namespace MicroSessions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MicroSessions\Model\Table\MicroSessionChaptersTable;

/**
 * MicroSessions\Model\Table\MicroSessionChaptersTable Test Case
 */
class MicroSessionChaptersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MicroSessions\Model\Table\MicroSessionChaptersTable
     */
    protected $MicroSessionChapters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MicroSessions.MicroSessionChapters',
        'plugin.MicroSessions.MicroSessions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MicroSessionChapters') ? [] : ['className' => MicroSessionChaptersTable::class];
        $this->MicroSessionChapters = $this->getTableLocator()->get('MicroSessionChapters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MicroSessionChapters);

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
