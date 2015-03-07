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
     * @var AdapterChain
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

    /*
    public function testGetAndHasIdentity()
    {
        $this->plugin->setAuthService($this->mockedAuthenticationService);

        $callbackIndex = 0;
        $callback = function () use (&$callbackIndex) {
            $callbackIndex++;
            return (bool) ($callbackIndex % 2);
        };

        $this->mockedAuthenticationService->expects($this->any())
                                          ->method('hasIdentity')
                                          ->will($this->returnCallback($callback));

        $this->mockedAuthenticationService->expects($this->any())
                                          ->method('getIdentity')
                                          ->will($this->returnCallback($callback));

        $this->assertTrue($this->plugin->hasIdentity());
        $this->assertFalse($this->plugin->hasIdentity());
        $this->assertTrue($this->plugin->hasIdentity());

        $callbackIndex= 0;

        $this->assertTrue($this->plugin->getIdentity());
        $this->assertFalse($this->plugin->getIdentity());
        $this->assertTrue($this->plugin->getIdentity());
    }

    public function testSetAndGetAuthAdapter()
    {
        $adapter1 = $this->mockedAuthenticationAdapter;
        $adapter2 = new AdapterChain();
        $this->plugin->setAuthAdapter($adapter1);

        $this->assertInstanceOf('\Zend\Authentication\Adapter\AdapterInterface', $this->plugin->getAuthAdapter());
        $this->assertSame($adapter1, $this->plugin->getAuthAdapter());

        $this->plugin->setAuthAdapter($adapter2);

        $this->assertInstanceOf('\Zend\Authentication\Adapter\AdapterInterface', $this->plugin->getAuthAdapter());
        $this->assertNotSame($adapter1, $this->plugin->getAuthAdapter());
        $this->assertSame($adapter2, $this->plugin->getAuthAdapter());
    }

    public function testSetAndGetAuthService()
    {
        $service1 = new AuthenticationService();
        $service2 = new AuthenticationService();
        $this->plugin->setAuthService($service1);

        $this->assertInstanceOf('\Zend\Authentication\AuthenticationService', $this->plugin->getAuthService());
        $this->assertSame($service1, $this->plugin->getAuthService());

        $this->plugin->setAuthService($service2);

        $this->assertInstanceOf('\Zend\Authentication\AuthenticationService', $this->plugin->getAuthService());
        $this->assertNotSame($service1, $this->plugin->getAuthService());
        $this->assertSame($service2, $this->plugin->getAuthService());
    }
    */
}
