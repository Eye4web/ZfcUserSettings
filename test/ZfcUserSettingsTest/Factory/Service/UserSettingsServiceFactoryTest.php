<?php

namespace Eye4web\ZfcUserSettingsTest\Service;

use Eye4web\ZfcUser\Settings\Factory\Service\UserSettingsServiceFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserSettingsServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingsServiceFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new UserSettingsServiceFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Eye4web\ZfcUser\Settings\Factory\Service\UserSettingsServiceFactory::createService
     */
    public function testCreateService()
    {
        $userSettingMapper = $this->getMockBuilder('Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper')
                                  ->disableOriginalConstructor()
                                  ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper')
                             ->willReturn($userSettingMapper);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\Settings\Service\UserSettingsService', $result);
    }
}
