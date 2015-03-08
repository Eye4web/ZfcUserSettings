<?php

namespace Eye4web\ZfcUserSettingsTest\Factory\View;

use Eye4web\ZfcUser\Settings\Factory\View\Helper\UserSettingHelperFactory;
use Zend\View\HelperPluginManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserSettingHelperFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingHelperFactory */
    protected $factory;

    /** @var ViewHelperManager */
    protected $viewHelperManager;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var HelperManager $viewHelperManager */
        $viewHelperManager = $this->getMockBuilder('Zend\View\HelperPluginManager')
                                  ->disableOriginalConstructor()
                                  ->getMock();
        $this->viewHelperManager = $viewHelperManager;

        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $viewHelperManager->expects($this->any())
                          ->method('getServiceLocator')
                          ->willReturn($serviceLocator);

        $factory = new UserSettingHelperFactory();
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

        $zfcUserIdentityViewHelper = $this->getMockBuilder('ZfcUser\View\Helper\ZfcUserIdentity')
                                          ->disableOriginalConstructor()
                                          ->getMock();

        $this->viewHelperManager->expects($this->once())
                                ->method('get')
                                ->with('ZfcUserIdentity')
                                ->willReturn($zfcUserIdentityViewHelper);

        $result = $this->factory->createService($this->viewHelperManager);

        $this->assertInstanceOf('Eye4web\ZfcUser\Settings\View\Helper\UserSettingHelper', $result);
    }
}
