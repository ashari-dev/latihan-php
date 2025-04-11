<?php
class Users{
    public static function userByEmail($pdo, $email) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll($pdo){
        return $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($pdo, $name, $email, $pass, $role) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?,?,?,?) ");
        return $stmt->execute([$name, $email, password_hash($pass, PASSWORD_BCRYPT), $role]);
    }

    public static function update($pdo, $id) {
        $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?");
        return $stmt->execute([$name, $email, password_hash($pass, PASSWORD_BCRYPT), $role, $id]);
    }

    public static function delete($pdo, $id) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}