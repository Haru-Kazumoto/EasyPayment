<?php
class User {
    public static function findByEmail($email) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
