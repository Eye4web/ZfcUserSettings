# Development

2015 7, March
-------------
- Add Module.php test
- Remove unused ModuleRouteListener() instance on Module::onBootstrap as it should be already in Application's Module
- Add Factory\Controller\Plugin\UserSettingPluginFactory test
- Add Factory\Service\UserSettingsServiceFactory test
- Add Factory\View\Helper\UserSettingHelperFactory test
- Changed passed Service Name in Mapper\DoctrineORM\UserSettingMapperFactory as 'Doctrine\ORM\EntityManager' as there is no service named 'zfcuser_doctrine_em'
- Add Factory\Mapper\DoctrineORM\UserSettingMapperFactory test
- Add Controller\Plugin\UserSettingPlugin test
- Add View\Helper\UserSettingHelper test ( UserSettingHelper::getSetting() still partially tested, still can't test calling 'ZfcUserIdentity' view helper inside it with view property)
- Add Service\UserSettingService test
- work on Mapper\DoctrineORM\UserSettingMapper test

2015 8, March
-------------
- Add "zf-commons/zfc-user-doctrine-orm" in "require" in composer.json to support call for "zfcuser_doctrine_em" service
- Changed back "Doctrine\ORM\EntityManager" service call to "zfcuser_doctrine_em" in Settings\Factory\Mapper\DoctrineORM\UserSettingMapperFactory and updated tests against it
- fix PSR2 cs and add .travis.yml config
- Mapper\DoctrineORM\UserSettingMapper fully tested
- All Entity\* tested
- Changelog
- View\Helper\UserSettingHelper tested
- Finally 100% code coverage!
