<?php
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Muilt DB',
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        'module1' => array(
            'class' => 'application.modules.TestModule.TestModule',
            'db' => require(dirname(__FILE__) . '/db_module1.php'),
        ),
        'module2' => array(
            'class' => 'application.modules.TestTestModule.TestTestModule',
            'db' => require(dirname(__FILE__) . '/db_module2.php'),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php'),
);
