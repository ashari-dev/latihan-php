<?php

require_once __DIR__. '/../models/Users.php';
require_once __DIR__. '/../utils/jwt.php';
require __DIR__. '/../config/db.php';

class UserControllers {
    public static function index() {
        global $pdo;
        authMiddleware();
        $users = Users::findAll($pdo);
        echo json_decode(['status'=> true, 'message'=>'Get all users', 'data'=> $users]);
    }

    public static function getUser($id) {
        global $pdo;
        authMiddleware();

        if (Users::getById($pdo, $id)) {
            $user = Users::getById($pdo, $id);
            echo json_decode(['status'=> true, 'message'=>'Get user', 'data'=> $user]);
        }else {
            http_response_code(400);
            echo json_decode(['status'=> false, 'error'=>'User not found']);
        }
    }

    public static function create() {
        global $pdo;
        authMiddleware('admin');

        $data = json_decode(file_get_contents("php://input"), true);
        if (Users::create($pdo, $data['name'], $data['email'], $data['password'], $data['role'])) {
            echo json_decode(['status'=> true,'message'=> 'User Create success']);
        }else {
            http_response_code(400);
            echo json_decode(['status'=> false, 'error'=>'Create user failed']);
        }
    }
    
    public static function update($id) {
        global $pdo;
        authMiddleware('admin');

        $data = json_decode(file_get_contents("php://input"), true);
        if (Users::update($pdo, $data['name'], $data['email'], $data['password'], $data['role'], $id)) {
            echo json_decode(['status'=> true,'message'=> 'User Update success']);
        }else {
            http_response_code(400);
            echo json_decode(['status'=> false, 'error'=>'Update user failed']);
        }
    }

    public static function delete($id) {
        global $pdo;
        authMiddleware('admin');

        if (Users::delete($pdo, $id)) {
            echo json_decode(['status'=> true,'message'=> 'User delete success']);
        }else {
            http_response_code(400);
            echo json_decode(['status'=> false, 'error'=>'Delete user failed']);
        }
    }
}