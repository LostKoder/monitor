<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 4:23 PM
 */

namespace Core\Process;


use Symfony\Component\Process\Process;

class DetachedProcess extends Process
{

    public function start(callable $callback = null, array $env = [])
    {
        $pid = pcntl_fork();
        if ($pid === -1) {
            throw new \Exception("Fork error");
        }

        posix_setsid();

        return parent::start($callback, $env);
    }

}