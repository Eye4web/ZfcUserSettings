<?php

namespace Eye4web\ZfcUserProfilePictureTest\Factory\Controller;

use Eye4web\ZfcUser\Settings\Factory\Controller\Plugin\UserSettingPluginFactory;
use Zend\Mvc\Controller\PluginManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserSettingPluginFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingPluginFactory */
    protected $factory;

    /** @var ControllerPluginManager */
    protected $controllerPluginManager;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var PluginManager $controllerPluginManager */
        $controllerPluginManager = $this->getMock('Zend\Mvc\Controller\PluginManager');
        $this->controllerPluginManager = $controllerPluginManager;

        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $controllerPluginManager->expects($this->any())
                          ->method('getServiceLocator')
                          ->willReturn($serviceLocator);

        $factory = new UserSettingPluginFactory();
        $this->factory = $factory;
    }

    public function testCreateService()
    {
        $userSettingService = $this->getMockBuilder('Eye4web\ZfcUser\Settings\Service\UserSettingsService')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\Settings\Service\UserSettingsService')
                             ->willReturn($userSettingService);

        $zfcuser_auth_service = $this->getMockBuilder('Zend\Authentication\AuthenticationService')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(1))
                             ->method('get')
                             ->with('zfcuser_auth_service')
                             ->willReturn($zfcuser_auth_service);

        $result = $this->factory->createService($this->controllerPluginManager);

        $this->assertInstanceOf('Eye4web\ZfcUser\Settings\Controller\Plugin\UserSettingPlugin', $result);
    }
}
