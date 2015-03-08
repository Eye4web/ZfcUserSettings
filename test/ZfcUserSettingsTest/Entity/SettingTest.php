<?php

namespace Eye4web\ZfcUserSettingsTest\Entity;

use Eye4web\ZfcUser\Settings\Entity\Setting as Entity;
use PHPUnit_Framework_TestCase;

class SettingTest extends PHPUnit_Framework_TestCase
{
    protected $setting;

    public function setUp()
    {
        $this->setting = new Entity();
    }

    public function testSetGetId()
    {
        $this->setting->setId(1);
        $this->assertEquals(1, $this->setting->getId());
    }

    public function testSetGetName()
    {
        $this->setting->setName('allow_email');
        $this->assertEquals('allow_email', $this->setting->getName());
    }

    public function testSetGetDescription()
    {
        $this->setting->setDescription('email show');
        $this->assertEquals('email show', $this->setting->getDescription());
    }

    public function testSetGetCategory()
    {
        $this->setting->setCategory('email');
        $this->assertEquals('email', $this->setting->getCategory());
    }
}
