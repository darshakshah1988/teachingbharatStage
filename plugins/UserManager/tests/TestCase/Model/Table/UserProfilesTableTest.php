<?php
declare(strict_types=1);

namespace UserManager\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use UserManager\Model\Table\UserProfilesTable;

/**
 * UserManager\Model\Table\UserProfilesTable Test Case
 */
class UserProfilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\UserProfilesTable
     */
    protected $UserProfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.UserManager.UserProfiles',
        'plugin.UserManager.Users',
        'plugin.UserManager.Locations',
        'plugin.UserManager.Occupations',
        'plugin.UserManager.PrimarySubjects',
        'plugin.UserManager.SecondarySubjects',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserProfiles') ? [] : ['className' => UserProfilesTable::class];
        $this->UserProfiles = $this->getTableLocator()->get('UserProfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->UserProfiles);

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
