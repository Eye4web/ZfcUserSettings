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

    public function setUp()
    {
        $this->userSettingsService = $this->getMock('Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface');
        $this->helper = new ViewHelper($this->userSettingsService);
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
            $view = $this->getMock('Zend\View\Renderer\PhpRenderer');
            $this->helper->setView($view);

            $mockZfcUserIdentity = $this->getMockBuilder('ZfcUser\View\Helper\ZfcUserIdentity')
                                        ->disableOriginalConstructor()
                                        ->getMock();
            $view->expects($this->once())
                 ->method('__call')
                 ->with('ZfcUserIdentity', array())
                 ->will($this->returnValue($mockZfcUserIdentity));
            $mockZfcUserIdentity->expects($this->once())
                                ->method('__invoke')
                                ->will($this->returnValue(new User()));
            $instance = $view->__call('ZfcUserIdentity', array())->__invoke();
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
