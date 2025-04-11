<?php

require_once __DIR__.'/../utils/jwt.php';

function authMiddleware($role = null) {
    $header = getallheaders;

    if (!isset($header['Authorization'])) {
        http_response_code(401);
        echo json_encode(['status'=> false,'error'=> 'Unauthorized']);
        exit;
    }

    $token = str_replace('Bearer', '', $header['Authorization']);

    try {
        $decoded = decodeToken($token);
        if ($role && $decoded->role!== $role) {
            http_response_code(403);
            echo json_encode(['status'=> false,'error'=> 'Forbidden']);
            exit;
        }
        return $decoded;
    } catch ( Exception $e ) {
        http_response_code(401);
        echo json_encode(['status'=> false,'error'=> 'Invalid token']);
        exit;
    }
}