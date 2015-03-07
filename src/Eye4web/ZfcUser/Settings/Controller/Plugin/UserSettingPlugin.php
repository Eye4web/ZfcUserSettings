<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Eye4web\ZfcUser\Settings\Controller\Plugin;

use Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use ZfcUser\Entity\UserInterface;

class UserSettingPlugin extends AbstractPlugin
{
    /**
     * @var UserSettingsServiceInterface
     */
    private $userSettingsService;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * @param UserSettingsServiceInterface $userSettingsService
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(UserSettingsServiceInterface $userSettingsService, AuthenticationServiceInterface $authenticationService)
    {
        $this->userSettingsService = $userSettingsService;
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return mixed
     */
    public function __invoke($setting, UserInterface $user = null)
    {
        return $this->getUserSetting($setting, $user);
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return mixed
     */
    public function getUserSetting($setting, UserInterface $user = null)
    {
        if (!$user) {
            $user = $this->authenticationService->getIdentity();
        }
        
        return $this->userSettingsService->getValue($setting, $user);
    }
}
