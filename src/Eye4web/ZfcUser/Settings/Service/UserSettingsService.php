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

namespace Eye4web\ZfcUser\Settings\Service;

use Eye4web\ZfcUser\Settings\Entity\Setting;
use Eye4web\ZfcUser\Settings\Mapper\UserSettingMapperInterface;
use ZfcUser\Entity\UserInterface;

class UserSettingsService implements UserSettingsServiceInterface
{
    /**
     * @var UserSettingMapperInterface
     */
    private $mapper;

    /**
     * @param UserSettingMapperInterface $mapper
     */
    public function __construct(UserSettingMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return string|null
     */
    public function getValue($setting, UserInterface $user)
    {
        $userSetting = $this->mapper->getUserSetting($setting, $user);

        if ($userSetting) {
            return $userSetting->getValue();
        }

        return null;
    }

    /**
     * @param string $setting
     * @return Setting
     */
    public function getSetting($setting)
    {

    }
}
