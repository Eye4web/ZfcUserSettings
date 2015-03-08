<?php

namespace Eye4web\ZfcUserSettingsTest\Entity;

use Eye4web\ZfcUser\Settings\Entity\Setting;
use Eye4web\ZfcUser\Settings\Entity\SettingValue as Entity;
use PHPUnit_Framework_TestCase;
use ZfcUser\Entity\User;

class SettingValueTest extends PHPUnit_Framework_TestCase
{
    protected $settingValue;

    public function setUp()
    {
        $this->settingValue = new Entity();
    }

    public function testSetGetSetting()
    {
        $setting = new Setting();
        $setting->setId(1);
        $setting->setName('allow_email');
        $this->settingValue->setSetting($setting);

        $this->assertInstanceOf(Setting::class, $this->settingValue->getSetting());
    }

    public function testSetGetUser()
    {
        $user = new User();
        $this->settingValue->setUser($user);

        $this->assertInstanceOf('ZfcUser\Entity\UserInterface', $this->settingValue->getUser());
    }

    public function testSetGetValue()
    {
        $this->settingValue->setValue('allow');
        $this->assertEquals('allow', $this->settingValue->getValue());
    }
}
