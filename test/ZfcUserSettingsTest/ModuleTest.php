<?php
namespace Eye4web\ZfcUserSettingsTest;

use Eye4web\ZfcUser\Settings\Module;
use PHPUnit_Framework_TestCase;
use Zend\Mvc\MvcEvent;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    /** @var \Eye4web\ZfcUser\Settings\Module */
    protected $module;

    public function setUp()
    {
        $this->module = new Module;
    }

    /**
     * @covers Eye4web\ZfcUser\Settings\Module::onBootstrap
     */
    public function testOnBootstrap()
    {
        $this->module->onBootstrap(new MvcEvent());
    }

    /**
     * @covers Eye4web\ZfcUser\Settings\Module::getConfig
     */
    public function testGetConfig()
    {
        $this->assertInternalType('array', $this->module->getConfig());
    }
}
