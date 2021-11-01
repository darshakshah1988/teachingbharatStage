<?php
declare(strict_types=1);

namespace Media\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Media\Model\Table\MediasTable;

/**
 * Media\Model\Table\MediasTable Test Case
 */
class MediasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Media\Model\Table\MediasTable
     */
    protected $Medias;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Media.Medias',
        'plugin.Media.Listings',
        'plugin.Media.MediaFiles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Medias') ? [] : ['className' => MediasTable::class];
        $this->Medias = TableRegistry::getTableLocator()->get('Medias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Medias);

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
