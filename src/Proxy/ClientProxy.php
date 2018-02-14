<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:49 PM
 */

namespace Core\Proxy;

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
        $cacheKey = sha1($uri);
        global $request;
        if ($this->cache->contains($cacheKey) && !$request->isNoCache()) {
            return $this->cache->fetch($cacheKey);
        }
        $exception = null;
        foreach ($this->servers() as $server) {
                $uri = $server . '/' . $uri;
            if (preg_match('/\?/', $uri)) {
                $uri .= '&imboss';
            } else {
                $uri .= '?imboss';
            }
            $response = parent::request($method, $uri, $options);
            $contents = $response->getBody()->getContents();
            if (!preg_match('/\{"response":"/', $contents)) {
                $exception = new \Exception("Response not successful");
                continue;
            }
            $this->cache->save($cacheKey, $contents);
            return $contents;
        }

        if ($exception) {
            $this->logger()->debug('Fetch failed', [
                'exception' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]);
            throw $exception;
        }
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function logger()
    {
        return LoggerFactory::create();
    }

    private function servers()
    {
        return [
            'https://apit1.malltina.com',
            'https://apit2.malltina.com',
        ];
    }
}