<?php
declare(strict_types=1);

namespace Announcement\Test\TestCase\Model\Table;

use Announcement\Model\Table\AnnouncementsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Announcement\Model\Table\AnnouncementsTable Test Case
 */
class AnnouncementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Announcement\Model\Table\AnnouncementsTable
     */
    protected $Announcements;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Announcement.Announcements',
        'plugin.Announcement.Listings',
        'plugin.Announcement.AdminUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Announcements') ? [] : ['className' => AnnouncementsTable::class];
        $this->Announcements = TableRegistry::getTableLocator()->get('Announcements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Announcements);

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
