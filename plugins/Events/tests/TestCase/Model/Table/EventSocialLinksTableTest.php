<?php
declare(strict_types=1);

namespace Events\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Events\Model\Table\EventSocialLinksTable;

/**
 * Events\Model\Table\EventSocialLinksTable Test Case
 */
class EventSocialLinksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Events\Model\Table\EventSocialLinksTable
     */
    protected $EventSocialLinks;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Events.EventSocialLinks',
        'plugin.Events.Events',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EventSocialLinks') ? [] : ['className' => EventSocialLinksTable::class];
        $this->EventSocialLinks = TableRegistry::getTableLocator()->get('EventSocialLinks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EventSocialLinks);

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
