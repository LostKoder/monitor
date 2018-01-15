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
use MySQLHandler\MySQLHandler;

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
        global $capsule;
        $streamHandler = new MySQLHandler($capsule->getConnection()->getPdo(),'logs');
        $streamHandler->setLevel(Logger::DEBUG);
        $logger = new Logger('app',[
            $streamHandler,
        ]);

        return $logger;
    }
}