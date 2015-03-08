<?php

namespace Eye4web\ZfcUserSettingsTest\Service;

use Eye4web\ZfcUser\Settings\Service\UserSettingsService;
use Eye4web\ZfcUser\Settings\Mapper\UserSettingMapperInterface;
use PHPUnit_Framework_TestCase;
use ZfcUser\Entity\User;

class UserSettingServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var UserSettingsService */
    protected $service;

    /** @var Eye4web\ZfcUser\Settings\Mapper\UserSettingMapperInterface */
    protected $mapper;

    public function setUp()
    {
        $mapper = $this->getMock('Eye4web\ZfcUser\Settings\Mapper\UserSettingMapperInterface');
        $this->mapper = $mapper;

        $service = new UserSettingsService($mapper);
        $this->service = $service;
    }

    /**
     * @dataProvider provideUserSetting
     */
    public function testGetValue($userSetting)
    {
        $userMock = $this->getMock('ZfcUser\Entity\UserInterface');
        $this->mapper->expects($this->once())
                     ->method('getUserSetting')
                     ->with('allow_email', $userMock)
                     ->willReturn($userSetting);

        if ($userSetting) {
            $userSetting->expects($this->once())
                             ->method('getValue')
                             ->willReturn('allow');
        }

        $this->service->getValue('allow_email', $userMock);
    }

    public function provideUserSetting()
    {
        return [
            [$this->getMock('Eye4web\ZfcUser\Settings\Entity\SettingValue')],
            [null],
        ];
    }
}
