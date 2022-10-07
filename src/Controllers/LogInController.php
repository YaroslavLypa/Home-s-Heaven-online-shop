<?php

namespace YaroslavLypa\HomesHaven\Controllers;

use mysqli;
use Rakit\Validation\Validator;
session_start();
class LogInController
{
    public static function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = json_decode(file_get_contents('php://input'), true);

        $validator = new Validator();
        $validation = $validator->validate($data, [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            http_response_code(422);
            echo json_encode($errors);
            return;
        }

        $login = filter_var(trim($data['login']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($data['password']), FILTER_SANITIZE_STRING);
        $password = md5($password . "qwerty12345");

        $mysql = new mysqli('localhost', 'root', '', 'code_it');

        $result = $mysql->query("SELECT * FROM `users` WHERE (`email` = '$login' OR `login` = '$login') AND `password`='$password' LIMIT 1");
        $user = $result->fetch_assoc();
        if (!$user){
            $errors[][] = 'Invalid credentials';
            http_response_code(422);
            echo json_encode($errors);
            return;
        }else{
            $_SESSION['login'] = $user['login'];
        }

        setcookie('user', json_encode([
            'name' => $user['name'],
            'email' => $user['email'],
            'login'=>$user['login'],
        ]), time() + 3600, "/");

        $mysql->close();
        echo json_encode(['authorized' => true]);
    }
}
