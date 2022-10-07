<?php

namespace YaroslavLypa\HomesHaven\Controllers;


class MainController
{
    public static function index(): void
    {
        require_once "src\Views\main.php";
    }
}