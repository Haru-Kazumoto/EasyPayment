<?php
class Classes
{
    public static function getAll()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->query('SELECT * FROM classes ORDER BY created_at DESC');

        $query->execute();

        return $query->fetchAll();
    }

    /**
     * koreksi dari gue: 
     * 1. sebelumnya ada double bracket di parameter function create
     */
    public static function create(array $data)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare('INSERT INTO classes (code, name) VALUES (:code, :name)');

        $result = $query->execute([
            ':code' => $data['code'],
            ':name' => $data['name'],
        ]);

        return $result;
    }

    public static function find(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT * FROM classes WHERE id = :id LIMIT 1");

        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(int $id, array $data)
    {
        $db = Database::getInstance()->pdo();

        // cek dlu udah ada apa belom bre
        $checkClass = $db->prepare("SELECT * FROM classes WHERE id = :id");
        $checkClass->execute([':id' => $id]);
        $existingClass = $checkClass->fetch(PDO::FETCH_ASSOC);

        if (!$existingClass) {
            return false;
        }

        // Cek duplicate code (kecuali user itu sendiri)
        if (!empty($data['code']) && $data['code'] !== $existingClass['code']) {
            $checkUsername = $db->prepare("SELECT id FROM classes WHERE code = :code AND id != :id");
            $checkUsername->execute([
                ':code' => $data['code'],
                ':id' => $id
            ]);

            if ($checkUsername->fetch()) {
                throw new Exception("Kode kelas sudah digunakan");
            }
        }

        // Build update query dynamically
        $updateFields = [];
        $params = [':id' => $id];

        // Update username jika ada dan berbeda
        if (!empty($data['name'])) {
            $updateFields[] = "name = :name";
            $params[':name'] = $data['name'];
        }

        // Update password HANYA jika diisi (tidak kosong)
        if (!empty($data['code'])) {
            $updateFields[] = "code = :code";
            $params[':code'] = $data['code'];
        }

        // Jika tidak ada yang diupdate, return true
        if (empty($updateFields)) {
            return true;
        }

        $query = $db->prepare("UPDATE classes SET " . implode(', ', $updateFields) . " WHERE id = :id");

        return $query->execute($params);
    }

    public static function delete(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare(
            "DELETE FROM classes WHERE id = :id"
        );

        return $query->execute([
            ':id' => $id
        ]);
    }
}
