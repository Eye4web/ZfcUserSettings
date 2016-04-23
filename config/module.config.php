<?php
return [
    'service_manager' => array(
        'factories' => array(
            'Eye4web\ZfcUser\Settings\Service\UserSettingsService'
                => 'Eye4web\ZfcUser\Settings\Factory\Service\UserSettingsServiceFactory',
            'Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper'
                => 'Eye4web\ZfcUser\Settings\Factory\Mapper\DoctrineORM\UserSettingMapperFactory',

        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'ZfcUserSetting'
                => 'Eye4web\ZfcUser\Settings\Factory\Controller\Plugin\UserSettingPluginFactory'
        )
    ),
    'view_helpers' => array(
        'factories' => array(
            'ZfcUserSetting'
                => 'Eye4web\ZfcUser\Settings\Factory\View\Helper\UserSettingHelperFactory'
        )
    ),
    'doctrine' => [
        'driver' => [
            'zfcuser_settings_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => [
                    'default' => __DIR__ . '/doctrine',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Eye4web\ZfcUser\Settings\Entity' => 'zfcuser_settings_driver'
                ]
            ]
        ],
    ],
];
