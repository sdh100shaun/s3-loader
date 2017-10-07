#!/usr/bin/env php
<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';
(new Dotenv(__DIR__))->load();
$app = new \Symfony\Component\Console\Application;
//$app->add(new \App\Command\GreeterCommand);
$app->run();