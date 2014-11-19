<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=DBNAME',
    'username' => 'USERNAME',
    'password' => 'PASSWORD',
    'charset' => 'utf8',
    'tablePrefix' => '',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => YII_ENV_DEV ? 0 : 2592000, // 1 month
];
