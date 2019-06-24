<?php
return [
    //デバックモードをオフに
    'debug' => false,

    'Security' => [
        'salt' => env('SALT'),
    ],

    //基本設定
    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'ja_JP'),
        'defaultTimezone' => env('APP_DEFAULT_TIMEZONE', 'Asia/Tokyo'),
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        //'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [APP . 'Template' . DS],
            'locales' => [APP . 'Locale' . DS],
        ],
    ],

    //DB設定
    $url = parse_url(env('DATABASE_URL')),
    'Datasources' => [
            'default' => [
                'className' => 'Cake\Database\Connection',
                'driver' => 'Cake\Database\Driver\Postgres',
                'persistent' => false,
                'host' => $url['host'],
                /*
                * CakePHP will use the default DB port based on the driver selected
                * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
                * the following line and set the port accordingly
                */
                //'port' => 'non_standard_port_number',
                'username' => $url['user'],
                'password' => $url['pass'],
                'database' => substr($url['path'], 1),
                /*
                * You do not need to set this flag to use full utf-8 encoding (internal default since CakePHP 3.6).
                */
                //'encoding' => 'utf8mb4',
                'timezone' => 'Asia/Tokyo',
                'flags' => [],
                'cacheMetadata' => true,
                'log' => false,

                /**
                 * Set identifier quoting to true if you are using reserved words or
                 * special characters in your table or column names. Enabling this
                 * setting will result in queries built using the Query Builder having
                 * identifiers quoted when creating SQL. It should be noted that this
                 * decreases performance because each query needs to be traversed and
                 * manipulated before being executed.
                 */
                'quoteIdentifiers' => false,

                /**
                 * During development, if using MySQL < 5.6, uncommenting the
                 * following line could boost the speed at which schema metadata is
                 * fetched from the database. It can also be set directly with the
                 * mysql configuration directive 'innodb_stats_on_metadata = 0'
                 * which is the recommended value in production environments
                 */
                //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],

                'url' => env('DATABASE_URL', null),
            ],
        ],
];
