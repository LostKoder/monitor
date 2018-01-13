<?php
require_once __DIR__.'/vendor/autoload.php';
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.ipify.org/?format=json', [
  'proxy' => 'socks5://127.0.0.1:9050',
]);

echo json_decode($response->getBody()->getContents())->ip;