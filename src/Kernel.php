<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 12:55 PM
 */

namespace Core;


use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Kernel
{

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $origin = $request->server->get('HTTP_ORIGIN');
        // return bullshit if it was not from rc or main server
        if (!in_array($origin,['https://malltina.com', 'https://rc1.malltina.com']) && !$request->query->has('imboss')) {
            return new Response(sha1(time()));
        }

        // prepare parameters
        $method = $request->getMethod();

        // make request to the amazon
        $url = 'https://www.amazon.com'.$request->getRequestUri();

        $response = $this->client->request($method, $url);

        $headers = [
          'access-control-allow-origin' => $origin,
          'cf-ray' => '3db09a8eed929be7-AMS',
          'vary' => 'Accept-Encoding',
        ];

        $contents = $response->getBody()->getContents();

        return new JsonResponse(['response' => $contents], 200, $headers);
    }
}