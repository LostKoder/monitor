<?php

require_once __DIR__.'/../bootstrap.php';


echo "Time, Success, Failed, Average Response Time (seconds), Success Rate\n";

/**
 * @param $capsule
 * @param $time
 */
function printRow($time, $label)
{
    global $capsule;
    $pdo = $capsule->getConnection()->getPdo();
    $sql = <<<SQL
SELECT COUNT(*), code from logs where `time` >= $time GROUP BY code 
SQL;


    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $success = $failed = 0;
    foreach ($stmt->fetchAll() as $result) {
        if ($result['code'] === "0") {
            $failed = $result['COUNT(*)'];
        } elseif ($result['code'] === null) {
            $success = $result['COUNT(*)'];
        }
    }


    $sql = <<<SQL
SELECT AVG(`duration`)from logs where `time` >= $time; 
SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $duration = $stmt->fetchAll()[0][0];
    $percent = ($failed * 100) / ($failed + $success);

    echo sprintf("%s, %d, %d, %.2f, %.2f%%\n",$label, $success, $failed, $duration, $percent);
}

printRow((new \Carbon\Carbon('24 hours ago'))->getTimestamp(), '24 hours ago');
printRow((new \Carbon\Carbon('7 days ago'))->getTimestamp(), '7 days ago');