<?php

return [
    'class' => 'yii\db\Connection',
    // ZMIENIONE: zamiast 127.0.0.1 jest 'db' (nazwa usługi z docker-compose.yml)
    'dsn' => 'mysql:host=db;dbname=praktyki',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];