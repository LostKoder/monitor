<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:54 PM
 */

namespace Core\Factory;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory
{

    private static $instance = null;

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public static function create()
    {
        if (self::$instance === null) {
            self::$instance = self::createInstance();
        }

        return self::$instance;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private static function createInstance()
    {
        $streamHandler = new StreamHandler(__DIR__ . '/../../var/app.log');
        $streamHandler->setLevel(Logger::DEBUG);
        $logger = new Logger('app',[
            $streamHandler,
        ]);

        return $logger;
    }
}