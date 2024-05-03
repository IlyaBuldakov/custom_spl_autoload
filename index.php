<?php

use ApplicationClasses\controller\Controller;
use ApplicationClasses\model\User;
use ApplicationClasses\Service;

require 'autoload.php';

$service = new Service();
$service->method();

echo '<br>';

$controller = new Controller();
$controller->method();

echo '<br>';

$user = new User();
$user->method();