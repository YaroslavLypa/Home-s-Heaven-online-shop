<?php

namespace YaroslavLypa\HomesHaven\Controllers;

use mysqli;
use Rakit\Validation\Validator;

class SignUpController
{
    public static function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = json_decode(file_get_contents('php://input'), true);

        $validator = new Validator();
        $validation = $validator->validate($data, [
            'email' => 'required|email|max:100',
            'register-login' => 'required|max:100',
            'name' => 'required|max:100',
            'register-password' => 'required',
            'birthdate' => 'required|date:Y-m-d',
            'country' => 'required|max:100',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors()->toArray();
            http_response_code(422);
            echo json_encode($errors);
            return;
        }

        $email = filter_var(trim($data['email']), FILTER_SANITIZE_STRING);
        $login = filter_var(trim($data['register-login']), FILTER_SANITIZE_STRING);
        $name = filter_var(trim($data['name']), FILTER_SANITIZE_STRING);
        $password = md5(filter_var(trim($data['register-password']), FILTER_SANITIZE_STRING) . "qwerty12345");
        $birthdate = filter_var(trim($data['birthdate']), FILTER_SANITIZE_STRING);
        $country = filter_var(trim($data['country']), FILTER_SANITIZE_STRING);

        $mysql = new mysqli('localhost', 'root', '', 'code_it');
        $result = $mysql->query("INSERT INTO `users` (`email`,`login`,`name`,`password`,`birthdate`,`country`) 
        VALUES ('$email','$login','$name','$password','$birthdate','$country')");
        if (!$result) {
            $errors[][] = "Email and login should be unique";
            http_response_code(422);
            echo json_encode($errors);
            return;
        }

        $mysql->close();
        echo json_encode(['registered' => true]);
    }
}
