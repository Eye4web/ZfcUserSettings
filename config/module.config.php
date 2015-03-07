<?php
return [
    'router' => [
        'routes' => [
            'zfcuser' => [
                'child_routes' => [
                    'settings' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/profile-picture',
                            'defaults' => [
                                'controller' => 'Eye4web\ZfcUser\ProfilePicture\Controller\ZfcUserProfilePictureController',
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'change' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => '/change',
                                ],
                                'may_terminate' => false,
                                'child_routes' => [
                                    'upload' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => '/upload',
                                            'defaults' => [
                                                'action'     => 'changeUpload',
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                        ]
                    ],
                ]
            ]
        ],
    ],
    'service_manager' => array(
        'factories' => array(
            'Eye4web\ZfcUser\Settings\Service\UserSettingsService'
                => 'Eye4web\ZfcUser\Settings\Factory\Service\UserSettingsServiceFactory',
            'Eye4web\ZfcUser\Settings\Mapper\DoctrineORM\UserSettingMapper'
                => 'Eye4web\ZfcUser\Settings\Factory\Mapper\DoctrineORM\UserSettingMapperFactory',

        ),
    ),
    'controllers' => array(
        'factories' => [
            'Eye4web\ZfcUser\Settings\Controller\ZfcUserSettingsController'
                => 'Eye4web\ZfcUser\ProfilePicture\Factory\Controller\ZfcUserSettingsControllerFactory'
        ]
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
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
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
