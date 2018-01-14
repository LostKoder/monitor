<?php


use Core\Factory\ClientFactory;
use Core\Kernel;
use Symfony\Component\HttpFoundation\Request;
phpinfo();
require_once __DIR__.'/bootstrap.php';

$request = Request::createFromGlobals();
$kernel = new Kernel(ClientFactory::create());
$response = $kernel->handle($request);
$response->send();