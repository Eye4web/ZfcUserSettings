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
use Eye4web\ZfcUser\Settings\Entity\SettingValue;
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
     * @return bool|int|mixed|null|string
     */
    public function getValue($setting, UserInterface $user)
    {
        $userSetting = $this->mapper->getUserSetting($setting, $user);

        if ($userSetting) {
            return $this->parseValue($userSetting->getValue(), $userSetting->getSetting()->getType());
        }

        return null;
    }

    /**
     * @param Setting $setting
     * @return bool|int|mixed|string
     */
    public function getDefaultValue(Setting $setting)
    {
        return $this->parseValue($setting->getDefaultValue(), $setting->getType());
    }

    /**
     * @param $setting
     * @param UserInterface $user
     * @param $value
     * @param bool $createIfNotExists
     * @return mixed
     */
    public function updateUserSetting($setting, UserInterface $user, $value, $createIfNotExists = false)
    {
        $setting = $this->mapper->getSetting($setting);
        $value = $this->parseValueForDatabase($value, $setting->getType());
        return $this->mapper->updateUserSetting($setting->getId(), $user, $value, $createIfNotExists);
    }

    /**
     * @param $category
     * @return Setting
     */
    public function getSettingsByCategory($category)
    {
        return $this->mapper->getSettingsByCategory($category);
    }

    /**
     * @param string $setting
     * @return Setting
     */
    public function getSetting($setting)
    {
        return $this->mapper->getSetting($setting);
    }

    /**
     * @param $value
     * @param $type
     * @return int|mixed|null|string
     */
    private function parseValueForDatabase($value, $type)
    {
        if (is_null($value)) {
            return null;
        }

        switch ($type) {
            case null:
                $value = null;
                break;
            case Setting::TYPE_BOOLEAN:
                if ($this->parseValue($value, $type)) {
                    $value = 1;
                } else {
                    $value = 0;
                }
                break;
            case Setting::TYPE_INTEGER:
                $value = (int) $value;
                break;
            case Setting::TYPE_STRING:
                $value = (string) $value;
                break;
            case Setting::TYPE_NULL:
            default:
                $value = null;
                break;
        }

        return $value;
    }

    /**
     * @param $value
     * @param $type
     * @return int|mixed|string
     */
    private function parseValue($value, $type)
    {
        if (is_null($value)) {
            return null;
        }
        
        switch ($type) {
            case null:
                $value = null;
                break;
            case Setting::TYPE_BOOLEAN:
                // Returns TRUE for "1", "true", "on" and "yes". Returns FALSE otherwise.
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                break;
            case Setting::TYPE_INTEGER:
                $value = (int) $value;
                break;
            case Setting::TYPE_STRING:
                $value = (string) $value;
                break;
            case Setting::TYPE_NULL:
            default:
                $value = null;
                break;
        }

        return $value;
    }
}
