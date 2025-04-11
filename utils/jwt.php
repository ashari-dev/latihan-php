<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateToken($user) {
    $payload = [
        'iss' => 'localhost',
        'iat' => time(),
        'exp' => time() + 3600,
        'sub' => $user['id'],
        'role' => $user['role']
    ];

    return JWT::generate($payload, $_ENV['JWT_SECRET'], 'HS256');
}

function decodeToken($token){
    return JWT::decode($token, new key( $_ENV['JWT_SECRET'], 'HS256'));
}