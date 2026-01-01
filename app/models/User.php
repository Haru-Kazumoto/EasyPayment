<?php
require '../app/helpers/trim_text.php';
require '../app/helpers/hash_password.php';

class User {

    public static function findByUsername($username) {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($data) {
        $db = Database::getInstance()->pdo();
        
        $query = $db->prepare("INSERT INTO users (fullname, username, password, is_admin) VALUES (:fullname, :username, :password, :is_admin)");

        $result = $query->execute([
            ':fullname' => $data['fullname'],
            ':username' => trim_text($data['username']),
            ':password' => hash_password(trim_text($data['password'])),
            ':is_admin' => $data['isAdmin']
        ]);

        if(!$result) {
            return false;
        }

        return $db->lastInsertId();
    }
}

