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
