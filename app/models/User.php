<?php
require '../app/helpers/trim_text.php';
require '../app/helpers/hash_password.php';

class User
{

    public static function findByUsername($username)
    {
        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public static function create($data)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("INSERT INTO users (fullname, username, password, is_admin) VALUES (:fullname, :username, :password, :is_admin)");

        $result = $query->execute([
            ':fullname' => $data['fullname'],
            ':username' => trim_text($data['username']),
            ':password' => hash_password(trim_text($data['password'])),
            ':is_admin' => $data['isAdmin']
        ]);

        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    public static function update(array $data, int $id)
    {
        $db = Database::getInstance()->pdo();

        // Cek apakah user exists
        $checkUser = $db->prepare("SELECT * FROM users WHERE id = :id");
        $checkUser->execute([':id' => $id]);
        $existingUser = $checkUser->fetch(PDO::FETCH_ASSOC);

        if (!$existingUser) {
            return false;
        }

        // Cek duplicate username (kecuali user itu sendiri)
        if (!empty($data['username']) && $data['username'] !== $existingUser['username']) {
            $checkUsername = $db->prepare("SELECT id FROM users WHERE username = :username AND id != :id");
            $checkUsername->execute([
                ':username' => $data['username'],
                ':id' => $id
            ]);

            if ($checkUsername->fetch()) {
                throw new Exception("Username sudah digunakan");
            }
        }

        // Build update query dynamically
        $updateFields = [];
        $params = [':id' => $id];

        // Update username jika ada dan berbeda
        if (!empty($data['username'])) {
            $updateFields[] = "username = :username";
            $params[':username'] = $data['username'];
        }

        // Update password HANYA jika diisi (tidak kosong)
        if (!empty($data['password'])) {
            $updateFields[] = "password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        // Jika tidak ada yang diupdate, return true
        if (empty($updateFields)) {
            return true;
        }

        $query = $db->prepare("UPDATE users SET " . implode(', ', $updateFields) . " WHERE id = :id");

        return $query->execute($params);
    }
}
