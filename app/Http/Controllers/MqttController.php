<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Geekshubs\RabbitMQ\RabbitMQ;
use PhpAmqpLib\Message\AMQPMessage;
use Geekshubs\RabbitMQ\Consumer;


class MqttController extends Controller
{
    public function send()
    {
        try {
            $rabbitMQ = self::MqConnection();
            $rabbitMQ->createConnect("Geekshubs");
            $rabbitMQ->createExchange("geekshubs.command.message", "topic", null, true, null, null, null, null);
            $rabbitMQ->publicMessage("Geekshubs", "geekshubs.command.message", 'geekshubs.prueba', json_encode("Hola todo el mundo"));
        } catch (Exception $e) {
            return response()->json([$e->getCode(), $e->getMessage()]);
        }
    }

    static function MqConnection()
    {
        return new RabbitMQ(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', '5672'),
            env('RABBITMQ_USERNAME', 'admin'),
            env('RABBITMQ_PASSWORD', 'password'),
            env('RABBITMQ_VHOST', '/')
        );
    }
}
