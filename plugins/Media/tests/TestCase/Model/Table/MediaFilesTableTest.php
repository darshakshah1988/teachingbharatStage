<?php
declare(strict_types=1);

namespace Media\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Media\Model\Table\MediaFilesTable;

/**
 * Media\Model\Table\MediaFilesTable Test Case
 */
class MediaFilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Media\Model\Table\MediaFilesTable
     */
    protected $MediaFiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Media.MediaFiles',
        'plugin.Media.Media',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MediaFiles') ? [] : ['className' => MediaFilesTable::class];
        $this->MediaFiles = TableRegistry::getTableLocator()->get('MediaFiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MediaFiles);

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
