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
// *
    /**
     * @dataProvider provideUserInstance
     *
    public function testGetUserSetting($instance)
    {
        if (! $instance) {
            $view = $this->getMock('Zend\View\Renderer\RendererInterface');

            $mockUser = $this->getMock('ZfcUser\Entity\UserInterface');
            $view->expects($this->once())
                 ->method('__call')
                 ->with('ZfcUserIdentity')
                 ->will($this->returnValue($mockUser));
        }

        $this->helper->getSetting('allow_email', $instance);
    }

    public function provideUserInstance()
    {
        return [
            [new User()],
            [null],
        ];
    }
*/
}
