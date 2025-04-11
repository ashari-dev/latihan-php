<?php

require_once __DIR__. '/../models/Users.php';
require_once __DIR__. '/../utils/jwt.php';
require __DIR__. '/../config/db.php';
require_once __DIR__. '/../utils/sanitize.php';
require_once __DIR__. '/../utils/logging.php';

class AuthController {
    public static function register() {
        global $pdo;
        $data = json_decode(file_get_contents("php://input"), true);
        $data = sanitize($data);

        if (Users::create($pdo, $data['name'], $data['email'], $data['password'], 'user')) {
            logMessage("Register Success: email={$data['email']}");
            echo json_decode(['status'=> true,'message'=> 'User register success']);
        }else {
            logMessage("Register failed: email={$data['email']}");
            http_response_code(401);
            echo json_decode(['status'=> false, 'error'=>'Register failed']);
        }
    } 

    public static function login() {
        global $pdo;
        $data = json_decode(file_get_contents("php://input"), true);
        $data = sanitize($data);

        $user = Users::userByEmail($pdo, $data['email']);
        if ($user && password_verify($data['password'], $user['password'])) {
            logMessage("Login Success: email={$data['email']}");
            echo json_decode(['status'=> true,'message'=>'Login Success']);
        } else {
            logMessage("Login failed: email={$data['email']}");
            http_response_code(401);
            echo json_decode(['status'=> false, 'error'=>'Invalid email and password']);
        }
    }
}