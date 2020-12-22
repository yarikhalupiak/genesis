<?php

$container = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $container->get('httpKernel');

$response = $kernel->handle();

$response->send();

