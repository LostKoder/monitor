<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:49 PM
 */

namespace Core\Proxy;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClientProxy extends Client
{
    public function request($method, $uri = '', array $options = [])
    {
        $options['connect_timeout'] = 5;
        foreach ($this->proxies() as $proxy) {
            $options = array_merge($options,['proxy' => $proxy->address]);
            try {
                return parent::request($method, $uri, $options);
            } catch (RequestException $e) {
                $this->proxyFailureHandler()->handle($proxy);
                continue;
            }
        }
    }

    /**
     * @return TorProxy[]
     */
    private function proxies(){

        /** @var TorProxy[] $proxies */
        $proxies = TorProxy::query()->where('enabled', true)->get();

        return $proxies;
    }

    /**
     * @return ProxyFailureHandler
     */
    private function proxyFailureHandler()
    {
        return new ProxyFailureHandler();
    }
}