<?php
namespace tests;

use Dotenv\Dotenv;
use extas\components\extensions\TSnuffExtensions;
use extas\components\plugins\Plugin;
use extas\components\plugins\PluginRepository;
use extas\components\values\RepositoryValue;
use extas\interfaces\repositories\IRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class RepositoryValueTest
 *
 * @package tests
 * @author jeyroik <jeyroik@gmail.com>
 */
class RepositoryValueTest extends TestCase
{
    use TSnuffExtensions;

    protected IRepository $pluginRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->pluginRepository = new PluginRepository();
        $this->addReposForExt([
            'pluginRepository' => PluginRepository::class
        ]);
        $this->createRepoExt(['pluginRepository']);
    }

    protected function tearDown(): void
    {
        $this->deleteSnuffExtensions();
        $this->pluginRepository->delete([Plugin::FIELD__CLASS => 'test']);
    }

    public function testBasicMethods()
    {
        $value = new RepositoryValue([RepositoryValue::FIELD__REPLACES => ['value' => 'test']]);

        $this->pluginRepository->create(new Plugin([Plugin::FIELD__CLASS => 'test']));

        $plugins = $value->build([
            RepositoryValue::FIELD__REPOSITORY_NAME => 'pluginRepository',
            RepositoryValue::FIELD__METHOD => 'all',
            RepositoryValue::FIELD__QUERY => ['class' => '@value']
        ]);
        $this->assertCount(1, $plugins);
        $plugin = array_shift($plugins);
        $this->assertTrue($plugin instanceof Plugin);

        $this->expectExceptionMessage('Invalid fields values');
        $value->build([]);
    }
}
