<?php

define('REDIS_HOST', getenv('REDIS_HOST') ?: '127.0.0.1');
define('REDIS_PORT', getenv('REDIS_PORT') ?: 6379);
define('REDIS_DATABASE', getenv('REDIS_DATABASE') ?: 0);
define('REDIS_PASSWORD', getenv('REDIS_PASSWORD') ?: null);

define('WORKER_SLEEP_TIME', getenv('WORKER_SLEEP_TIME') ?: 1);
