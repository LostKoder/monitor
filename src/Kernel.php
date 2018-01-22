<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 12:55 PM
 */

namespace Core;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
        $url = 'https://www.google.com'.$request->getRequestUri();

        try {
            $response = $this->client->request($method, $url);
        } catch (RequestException $e) {
            $response = $e->getResponse();
        }
        $headers = [
          'cf-ray' => '3db09a8eed929be7-AMS',
          'vary' => 'Accept-Encoding',
        ];

        $contents = $response->getBody()->getContents();

        return new Response($contents, $response->getStatusCode(), $headers);
    }
}