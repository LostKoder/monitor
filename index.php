<?php


use Core\Factory\ClientFactory;
use Core\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/bootstrap.php';

/** @var Request $request */
$request = Request::createFromGlobals();
$kernel = new Kernel(ClientFactory::create());
$response = $kernel->handle($request);
$response->send();