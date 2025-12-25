<?php
class User {

    public static function findByUsername($username) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($name, $email, $password) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $password]);
    }
}
