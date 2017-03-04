<?php

use DI\ContainerBuilder;
use IdNet\StackRunner\StackRunner;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

require_once __DIR__.'/../vendor/autoload.php';

/** @var StackRunner $app */
$app = (new ContainerBuilder)
    ->addDefinitions(__DIR__.'/../src/di-config.php')
    ->build()
    ->get(StackRunner::class);

$response = $app->process(ServerRequestFactory::fromGlobals());

(new SapiEmitter)->emit($response);

