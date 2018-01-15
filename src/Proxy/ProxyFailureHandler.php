<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:59 PM
 */

namespace Core\Proxy;


use Carbon\Carbon;

class ProxyFailureHandler
{

    public function handle(TorProxy $proxy)
    {
        $proxy->enabled = false;
        $proxy->disabled_at = Carbon::now();
        $proxy->save();
    }
}