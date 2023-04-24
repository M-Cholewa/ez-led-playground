<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');

Router::post('login', 'SecurityController');
Router::get('logout', 'SecurityController');

Router::get('devices', 'DeviceController');
Router::get('newDevice', 'DeviceController');
Router::post('removeDevice', 'DeviceController');
Router::post('searchDevice', 'DeviceController');
Router::get('telemetry', 'DeviceController');

Router::get('workspaces', 'WorkspaceController');
Router::get('newWorkspace', 'WorkspaceController');
Router::post('removeWorkspace', 'WorkspaceController');
Router::post('searchWorkspace', 'WorkspaceController');
Router::post('updateWorkspaceBytes', 'WorkspaceController');
Router::post('getWorkspaceBytes', 'WorkspaceController');
Router::get('draw', 'WorkspaceController');

Router::run($path);