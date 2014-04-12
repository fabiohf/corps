<?php

namespace Tropa;

use Tropa\Model\Setor;
use Tropa\Model\SetorTable;
use Tropa\Model\Lanterna;
use Tropa\Model\LanternaTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\I18n\Translator\Translator;
use Zend\Validator\AbstractValidator;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translationPath = realpath(__DIR__ . '/../../vendor/zendframework/zendframework/resources/languages');
        $translator->addTranslationFile(
            'phpArray',
            $translationPath . '/pt_BR/Zend_Validate.php'
        );

        AbstractValidator::setDefaultTranslator($translator);
        $GLOBALS['sm'] = $e->getApplication()->getServiceManager();
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Tropa\Model\SetorTable' => function ($sm) {
                    $tableGateway = $sm->get('SetorTableGateway');
                    $table = new SetorTable($tableGateway);
                    return $table;
                },
                'SetorTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Setor());
                    return new TableGateway('setor', $dbAdapter, null, $resultSetPrototype);
                },
                'Tropa\Model\LanternaTable' => function ($sm) {
                        $tableGateway = $sm->get('LanternaTableGateway');
                        $table = new LanternaTable($tableGateway);
                        return $table;
                },
                'LanternaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Lanterna());
                    return new TableGateway('lanterna', $dbAdapter, null, $resultSetPrototype);
                }
            ),
        );
    }
}
