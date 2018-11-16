<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'maindatabase' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => getenv('PROPEL_BD_DSN'),
                    'user'       => getenv('PROPEL_BD_USER'),
                    'password'   => getenv('PROPEL_BD_PASS'),
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'maindatabase',
            'connections' => ['maindatabase']
        ],
        'generator' => [
            'defaultConnection' => 'maindatabase',
            'connections' => ['maindatabase']
        ]
    ]
];

