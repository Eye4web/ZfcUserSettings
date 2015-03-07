<?php

namespace Eye4web\ZfcUserSettingsTest\Controller\Plugin;

use Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface;
use Eye4web\ZfcUser\Settings\Controller\Plugin\UserSettingPlugin as Plugin;
use Zend\Authentication\AuthenticationService;
use ZfcUser\Entity\User;

class UserSettingPluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Plugin
     */
    protected $plugin;

    /**
     *
     * @var AuthenticationService
     */
    protected $authenticationService;

    public function setUp()
    {
        $this->userSettingService = $this->getMock('Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface');
        $this->authenticationService = $this->getMock('Zend\Authentication\AuthenticationServiceInterface');

        $this->plugin = new Plugin($this->userSettingService, $this->authenticationService);
    }

    public function testInvoke()
    {
        $instance = new User();
        $this->plugin->__invoke('allow_email', $instance);
    }

    /**
     * @dataProvider provideUserInstance
     */
    public function testGetUserSetting($instance)
    {
        if (! $instance) {
            $mockUser = $this->getMock('ZfcUser\Entity\UserInterface');
            $this->authenticationService->expects($this->once())
                 ->method('getIdentity')
                 ->will($this->returnValue($mockUser));
        }

        $this->plugin->getUserSetting('allow_email', $instance);
    }

    public function provideUserInstance()
    {
        return [
            [new User()],
            [null],
        ];
    }
}
