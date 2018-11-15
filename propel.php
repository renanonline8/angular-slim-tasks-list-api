<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'maindatabase' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=angular_slim_tasks_list',
                    'user'       => 'root',
                    'password'   => '',
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

