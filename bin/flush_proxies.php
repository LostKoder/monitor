<?php

use Core\Proxy\TorProxy;
use Symfony\Component\Process\Process;

require_once __DIR__.'/../bootstrap.php';

/** @var TorProxy[] $proxies */
$proxies = TorProxy::query()->where('enabled',false)->get();
foreach ($proxies as $proxy) {

    // kill existing process
    $process = new Process('kill -9 $(ps aux | grep '.$proxy->config_file.' | grep -v grep | sed -r \'s/ +/\t/g\' | cut -f2)');
    $process->run();
    echo $process->getOutput();
    echo $process->getErrorOutput();

    // run process again
    $pid = new \Core\Process\DetachedProcess(sprintf('tor -f %s  & > /dev/null', $proxy->config_file));
    $pid->setTimeout(2);
    $pid->run();

    // wait 5 seconds to process start ups
    sleep(20);

    // set proxy as enabled and services can use it
    $proxy->enabled = true;
    $proxy->save();
}

