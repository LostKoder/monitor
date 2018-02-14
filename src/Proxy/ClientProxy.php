<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:49 PM
 */

namespace Core\Proxy;


use Carbon\Carbon;
use Core\Factory\LoggerFactory;
use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClientProxy extends Client
{
    private $cache;

    public function __construct(array $config = [], Cache $cache = null)
    {
        parent::__construct($config);
        $this->cache = $cache;
        if ($cache === null) {
            $this->cache = new VoidCache();
        }
    }

    public function request($method, $uri = '', array $options = [])
    {
        if ($this->cache->contains($uri)) {
            return $this->cache->fetch($uri);
        }
            try {
                $response = parent::request($method, $uri, $options);
                $this->cache->save($uri, $response);
                return $response;
            } catch (RequestException $e) {
                // if error was not 404 or 503 mark proxy as failed
                if (in_array($e->getCode(), [404, 503, 200])) {
                    throw $e;
                }
                $this->logger()->debug('Proxy connection failed', [
                    'exception' => $e->getMessage(),
                    'code' => $e->getCode()
                ]);
        }
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function logger()
    {
        return LoggerFactory::create();
    }
}