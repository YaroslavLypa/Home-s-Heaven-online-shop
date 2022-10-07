<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use Dotenv\Dotenv;
use YaroslavLypa\HomesHaven\Controllers\MainController;
use YaroslavLypa\HomesHaven\Controllers\LogInController;
use YaroslavLypa\HomesHaven\Controllers\LogOutController;
use YaroslavLypa\HomesHaven\Controllers\OrderController;
use YaroslavLypa\HomesHaven\Controllers\SignUpController;
use YaroslavLypa\HomesHaven\Controllers\UserController;
use YaroslavLypa\HomesHaven\Router;

// Load env variables
$dotenv = Dotenv::createImmutable(__DIR__)
  ->load();

// Router
$router = new Router();
$router
    ->get('/', [MainController::class, 'index'])
    ->post('/sign-up', [SignUpController::class, 'store'])
    ->post('/log-in', [LogInController::class, 'store'])
    ->post('/log-out', [LogOutController::class, 'destroy'])
    ->get('/user', [UserController::class, 'index'])
    ->post('/orders', [OrderController::class, 'store'])
    ->handle();
