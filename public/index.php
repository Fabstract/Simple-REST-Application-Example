<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Fabstract\Component\SimpleRestApplication\App\Application();
/** @noinspection PhpUnhandledExceptionInspection */
$app->run();
