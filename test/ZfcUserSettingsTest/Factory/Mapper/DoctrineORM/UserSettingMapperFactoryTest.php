<?php

namespace Eye4web\ZfcUserProfilePictureTest\Factory\Mapper\DoctrineORM;

use Doctrine\ORM\EntityManager;
use Eye4web\ZfcUser\Settings\Factory\Mapper\DoctrineORM\UserSettingMapperFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserSettingMapperFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingMapperFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new UserSettingMapperFactory();
        $this->factory = $factory;
    }

    public function testCreateService()
    {
        $objectManager = $this->getMockBuilder('Doctrine\ORM\EntityManagerInterface')
                              ->disableOriginalConstructor()
                              ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Doctrine\ORM\EntityManager')
                             ->willReturn($objectManager);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper', $result);
    }
}
