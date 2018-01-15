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
        // prepare parameters
        $method = $request->getMethod();
        // make request to the amazon
        $url = 'https://www.amazon.com'.$request->getRequestUri();

        $response = $this->client->request($method, $url);

        $headers = [
          'access-control-allow-origin' => 'malltina.com, rc1.malltina.com',
          'cf-ray' => '3db09a8eed929be7-AMS',
          'vary' => 'Accept-Encoding',
        ];

        $contents = $response->getBody()->getContents();

//        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(['response' => $contents], 200, $headers);
//        }

//        return new Response($contents, 200, $headers);
    }
}