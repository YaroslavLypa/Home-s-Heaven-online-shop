<?php

namespace YaroslavLypa\HomesHaven\Controllers;


class UserController{
    public static function index(): void
    {
        $user = json_decode($_COOKIE['user'] ?? '[]', true);
        if (empty($user)) {
            header('Location: /');
        } else {
            require_once 'src/Views/user.php';
        }
    }
}