<?php

require_once __DIR__.'/vendor/autoload.php';


use Illuminate\Database\Capsule\Manager as Capsule;

(new \Symfony\Component\Dotenv\Dotenv())->load(__DIR__.'/.env');

$capsule = new Capsule;

$capsule->addConnection([
  'driver'    => 'mysql',
  'host'      => 'localhost',
  'database'  => getenv("DB_DATABASE"),
  'username'  => getenv("DB_USERNAME"),
  'password'  => getenv("DB_PASSWORD"),
  'charset'   => 'utf8',
  'collation' => 'utf8_unicode_ci',
  'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();