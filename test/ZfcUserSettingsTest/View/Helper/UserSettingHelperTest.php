<?php

namespace ZfcUserTest\View\Helper;

use Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface;
use Eye4web\ZfcUser\Settings\View\Helper\UserSettingHelper as ViewHelper;
use ReflectionClass;
use ZfcUser\Entity\User;

class UserSettingHelperTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    protected $userSettingsService;

    protected $zfcUserIdentityHelper;

    public function setUp()
    {
        $this->userSettingsService   = $this->getMock('Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface');
        $this->zfcUserIdentityHelper = $this->getMockBuilder('ZfcUser\View\Helper\ZfcUserIdentity')
                                            ->disableOriginalConstructor()
                                            ->getMock();
        $this->helper = new ViewHelper($this->userSettingsService, $this->zfcUserIdentityHelper);
    }

    public function testInvoke()
    {
        $instance = new User();
        $this->assertNull($this->helper->__invoke('allow_email', $instance));
    }

    /**
     * @dataProvider provideUserInstance
     */
    public function testGetUserSetting($instance)
    {
        if (!$instance) {
            $user = new User();
            $this->zfcUserIdentityHelper->expects($this->once())
                 ->method('__invoke')
                 ->will($this->returnValue($user));

            $instance = $this->zfcUserIdentityHelper->__invoke();
        }

        $this->userSettingsService->expects($this->once())
                                  ->method('getValue')
                                  ->with('allow_email', $instance)
                                  ->will($this->returnValue('allow'));

        $this->helper->getSetting('allow_email', $instance);
    }

    public function provideUserInstance()
    {
        return [
            [new User()],
            [null],
        ];
    }
}
