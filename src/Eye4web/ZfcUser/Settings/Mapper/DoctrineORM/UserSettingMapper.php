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

namespace Eye4web\ZfcUser\Settings\Mapper\DoctrineORM;

use Doctrine\ORM\EntityManagerInterface;
use Eye4web\ZfcUser\Settings\Entity\Setting;
use Eye4web\ZfcUser\Settings\Entity\SettingValue;
use Eye4web\ZfcUser\Settings\Mapper\UserSettingMapperInterface;
use ZfcUser\Entity\UserInterface;

class UserSettingMapper implements UserSettingMapperInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $setting
     * @param UserInterface $user
     * @return SettingValue
     */
    public function getUserSetting($setting, UserInterface $user)
    {
        return $this->entityManager->getRepository("Eye4web\ZfcUser\Settings\Entity\SettingValue")->findOneBy([
            'user' => $user->getId(),
            'setting' => $setting
        ]);
    }

    /**
     * @param string $setting
     * @return Setting
     */
    public function getSetting($setting)
    {
        return $this->entityManager->find("Eye4web\ZfcUser\Settings\Entity\Setting", $setting);
    }

}
