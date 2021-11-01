<?php
declare(strict_types=1);

namespace UserManager\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use UserManager\Model\Table\UserDocumentsTable;

/**
 * UserManager\Model\Table\UserDocumentsTable Test Case
 */
class UserDocumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\UserDocumentsTable
     */
    protected $UserDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.UserManager.UserDocuments',
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
        $config = $this->getTableLocator()->exists('UserDocuments') ? [] : ['className' => UserDocumentsTable::class];
        $this->UserDocuments = $this->getTableLocator()->get('UserDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserDocuments);

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
