<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('devices', 'DeviceController');
Router::get('newDevice', 'DeviceController');
Router::post('createDevice', 'DeviceController');
Router::post('removeDevice', 'DeviceController');
Router::post('search', 'DeviceController');
Router::get('telemetry', 'DeviceController');

Router::post('login', 'SecurityController');
Router::get('logout', 'SecurityController');

Router::run($path);