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

namespace Eye4web\ZfcUser\Settings\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Eye4web\ZfcUser\Settings\Service\UserSettingsServiceInterface;
use ZfcUser\Entity\UserInterface;
use ZfcUser\View\Helper\ZfcUserIdentity;

class UserSettingHelper extends AbstractHelper
{
    /**
     * @var UserSettingsServiceInterface
     */
    private $userSettingsService;

    /**
     * @var ZfcUserIdentity
     */
    private $zfcUserIdentity;

    /**
     * @param UserSettingsServiceInterface $userSettingsService
     */
    public function __construct(UserSettingsServiceInterface $userSettingsService, ZfcUserIdentity $zfcUserIdentity)
    {
        $this->userSettingsService = $userSettingsService;
        $this->zfcUserIdentity     = $zfcUserIdentity;
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return null|string
     */
    public function __invoke($setting, UserInterface $user = null)
    {
        return $this->getSetting($setting, $user);
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return
     */
    public function getSetting($setting, UserInterface $user = null)
    {
        if (!$user) {
            $user = $this->zfcUserIdentity->__invoke();
        }

        return $this->userSettingsService->getvalue($setting, $user);
    }
}
