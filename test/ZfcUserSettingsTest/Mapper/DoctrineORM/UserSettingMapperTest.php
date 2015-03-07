<?php

namespace Eye4web\ZfcUserSettingsTest\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper;
use PHPUnit_Framework_TestCase;
use ZfcUser\Entity\User;

class UserSettingMapperMapperTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingMapper */
    protected $mapper;

    /** @var \Doctrine\ORM\EntityManagerInterface */
    protected $objectManager;

    public function setUp()
    {
        /** @var \Doctrine\ORM\EntityManagerInterface $objectManager */
        $objectManager = $this->getMockBuilder('Doctrine\ORM\EntityManagerInterface')
                              ->disableOriginalConstructor()
                              ->getMock();
        $this->objectManager = $objectManager;
        
        $mapper = new UserSettingMapper($objectManager);

        $this->mapper = $mapper;
    }

    public function testGetSetting()
    {
     /*   $objectRepository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        $this->objectManager->expects($this->once())
                            ->method('getRepository')
                            ->with('Eye4web\ZfcUser\Settings\Entity\Setting')
                            ->will($this->returnValue($objectRepository));
        $objectRepository->expects($this->once())
                   ->method('find')
                   ->will($this->returnValue(new Setting()));

        $this->assertInstanceOf('ZfcUser\Settings\Entity\Setting', $this->mapper->getSetting(1));
      */
    }
}
