<?php

namespace ZfcUserTest\View\Helper;

use Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface;
use Eye4web\ZfcUser\Settings\View\Helper\UserSettingHelper as ViewHelper;
use ZfcUser\Entity\User;

class UserSettingHelperTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    protected $userSettingsService;

    public function setUp()
    {
        $this->userSettingsService = $this->getMock('Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface');
        $this->helper = new ViewHelper($this->userSettingsService);
    }

    public function testInvoke()
    {
        $instance = new User();
        $this->helper->__invoke('allow_email', $instance);
    }
}
