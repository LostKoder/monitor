<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:00 PM
 */

namespace Core\Factory;


use Core\Proxy\ClientProxy;
use GuzzleHttp\Cookie\CookieJar;

class ClientFactory
{

    public static function create()
    {
        $cookie = new CookieJar();
        return new ClientProxy([
          'headers' => [
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Referer' => 'https://www.amazon.com/gp/product/B00LOQR37C/ref=s9_acss_bw_cg_SGHolCG_2b1_w?pf_rd_m=ATVPDKIKX0DER&pf_rd_s=merchandised-search-4&pf_rd_r=QHFEXK80DY3JFZ2H69VW&pf_rd_t=101&pf_rd_p=4b527c6a-9241-4637-a0d9-25f82f5ddeec&pf_rd_i=10971181011',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Accept-Language' => 'en-US,en;q=0.8',
          ],
          'cookies' => $cookie,
        ]);
    }
}