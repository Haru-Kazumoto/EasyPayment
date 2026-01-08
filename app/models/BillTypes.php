<?php
class BillTypes
{
    public static function getAll()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->query('SELECT * FROM bills_type');
        $query->execute();

        return $query->fetchAll();
    }

    public static function create(array $data)
    {
        try {
            $db = Database::getInstance()->pdo();

            $query = $db->prepare('INSERT INTO bills_type (code, name, description) VALUES (:code, :name, :description)');

            $result = $query->execute([
                ':code' => $data['code'],
                ':name' => $data['name'],
                ':description' => $data['description']
            ]);

            return $result;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                // kalo kode nya udah ada
                return false;
            }

            throw $e;
        }
    }

    public static function findOne(int $type_id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT * FROM bills_type WHERE id = :id LIMIT 1");

        $query->execute([':id' => $type_id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(array $data, int $id)
    {
        $db = Database::getInstance()->pdo();

        // cek dlu udah ada apa belom bre
        $checkType = $db->prepare("SELECT * FROM bills_type WHERE id = :id");
        $checkType->execute([':id' => $id]);
        $existingType = $checkType->fetch(PDO::FETCH_ASSOC);

        if (!$existingType) {
            return false;
        }

        // Cek duplicate code (kecuali user itu sendiri)
        if (!empty($data['code']) && $data['code'] !== $existingType['code']) {
            $checkUsername = $db->prepare("SELECT id FROM bills_type WHERE code = :code AND id != :id");
            $checkUsername->execute([
                ':code' => $data['code'],
                ':id' => $id
            ]);

            if ($checkUsername->fetch()) {
                throw new Exception("Jenis tagihan sudah digunakan");
            }
        }

        // Build update query dynamically
        $updateFields = [];
        $params = ['id' => $id];

        if (!empty($data['name'])) {
            $updateFields[] = "name = :name";
            $params['name'] = $data['name'];
        }

        if (!empty($data['code'])) {
            $updateFields[] = "code = :code";
            $params['code'] = $data['code'];
        }

        if (!empty($data['description'])) {
            $updateFields[] = "description = :description";
            $params['description'] = $data['description'];
        }

        // Jika tidak ada yang diupdate, return true
        if (empty($updateFields)) {
            return true;
        }

        // die(json_encode($params));
        // exit;

        $query = $db->prepare("UPDATE bills_type SET " . implode(', ', $updateFields) . " WHERE id = :id");

        return $query->execute($params);
    }

    public static function delete(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare(
            "DELETE FROM bills_type WHERE id = :id"
        );

        return $query->execute([
            ':id' => $id
        ]);
    }
}
