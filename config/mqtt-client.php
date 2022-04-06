<?php

declare(strict_types=1);

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Repositories\MemoryRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | Default MQTT Connection
    |--------------------------------------------------------------------------
    |
    | This setting defines the default MQTT connection returned when requesting
    | a connection without name from the facade.
    |
    */

    'default_connection' => 'default',

    /*
    |--------------------------------------------------------------------------
    | MQTT Connections
    |--------------------------------------------------------------------------
    |
    | These are the MQTT connections used by the application. You can also open
    | an individual connection from the application itself, but all connections
    | defined here can be accessed via name conveniently.
    |
    */

    'connections' => [

        'default' => [

            // The host and port to which the client shall connect.
            'host' => env('MQTT_HOST', 'localhost'),
            'port' => env('MQTT_PORT', 1883),
            'v-host' => env('RABBITMQ_VHOST'), '/',
            'auth' => [
                'username' => env('RABBITMQ_USERNAME'),
                'password' => env('RABBITMQ_PASSWORD'),
            ],



        ],

    ],

];
