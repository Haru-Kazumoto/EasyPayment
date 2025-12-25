<?php
class User {
    public static function findByEmail($email) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public static function create($name, $email, $password) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $password]);
    }
}
