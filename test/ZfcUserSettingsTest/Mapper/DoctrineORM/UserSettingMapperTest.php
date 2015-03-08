<?php

namespace Eye4web\ZfcUserSettingsTest\Doctrine\ORM;

use Doctrine\ORM\EntityManagerInterface;
use Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper;
use Eye4web\ZfcUser\Settings\Entity\Setting;
use PHPUnit_Framework_TestCase;
use ZfcUser\Entity\User;

class UserSettingMapperTest extends PHPUnit_Framework_TestCase
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
        $setting = new Setting();
        $this->objectManager->expects($this->once())
                            ->method('find')
                            ->with('Eye4web\ZfcUser\Settings\Entity\Setting', 1)
                            ->will($this->returnValue($setting));
        $this->assertSame($setting, $this->mapper->getSetting(1));
    }
}
