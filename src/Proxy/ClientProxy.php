<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:49 PM
 */

namespace Core\Proxy;


use Core\Factory\LoggerFactory;
use GuzzleHttp\Client;

class ClientProxy extends Client
{
    public function request($method, $uri = '', array $options = [])
    {
            $options = array_merge($options,['proxy' => 'socks5://127.0.0.1:9050']);
            $start = microtime(true);
            $response = parent::request($method, $uri, $options);
            $this->logger()->debug('Proxy connection succeed',['duration' => microtime(true) - $start]);
            return $response;
        }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function logger(){
        return LoggerFactory::create();
    }
}