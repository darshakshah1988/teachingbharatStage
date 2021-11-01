<?php
declare(strict_types=1);

namespace AdminUserManager\Test\TestCase\Model\Table;

use AdminUserManager\Model\Table\AdminUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * AdminUserManager\Model\Table\AdminUsersTable Test Case
 */
class AdminUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \AdminUserManager\Model\Table\AdminUsersTable
     */
    protected $AdminUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.AdminUserManager.AdminUsers',
        'plugin.AdminUserManager.Listings',
        'plugin.AdminUserManager.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AdminUsers') ? [] : ['className' => AdminUsersTable::class];
        $this->AdminUsers = TableRegistry::getTableLocator()->get('AdminUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AdminUsers);

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
