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
                $start = microtime(true);
                $response = parent::request($method, $uri, $options);
                $proxy->used_at = Carbon::now();
                $this->logger()->debug('Proxy connection succeed',['duration' => microtime(true) - $start]);
                $proxy->save();
                return $response;
            } catch (RequestException $e) {
                $this->logger()->debug('Proxy connection failed',[
                    'exception' => $e,
                ]);
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
        $proxies = TorProxy::query()
            ->orderBy('used_at','asc')
            ->where('enabled', true)
            ->get();

        return $proxies;
    }

    /**
     * @return ProxyFailureHandler
     */
    private function proxyFailureHandler()
    {
        return new ProxyFailureHandler();
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    private function logger(){
        return LoggerFactory::create();
    }
}