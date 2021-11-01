<?php
declare(strict_types=1);

namespace UserManager\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use UserManager\Model\Table\UsersDocumentsTable;

/**
 * UserManager\Model\Table\UsersDocumentsTable Test Case
 */
class UsersDocumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\UsersDocumentsTable
     */
    protected $UsersDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.UserManager.UsersDocuments',
        'plugin.UserManager.Users',
        'plugin.UserManager.DocumentTypes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UsersDocuments') ? [] : ['className' => UsersDocumentsTable::class];
        $this->UsersDocuments = $this->getTableLocator()->get('UsersDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UsersDocuments);

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
