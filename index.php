<?php

$loader = require 'vendor/autoload.php';
$loader->add('Utils',  'bicycle');
$loader->add('Controllers', 'app');

Utils\Router::dispatch();
