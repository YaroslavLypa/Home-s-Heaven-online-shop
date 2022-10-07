<?php

namespace YaroslavLypa\HomesHaven\Controllers;
session_start();

class LogOutController{
    public static function destroy(): void
    {
        unset($_SESSION['login']);
        setcookie('user', null, time() - 3600, '/');
        header('Location: /');
    }
}
