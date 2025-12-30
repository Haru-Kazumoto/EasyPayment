<?php
class BillTypes {
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
        } catch(PDOException $e) {
            if($e->getCode() == 23000) {
                // kalo kode nya udah ada
                return false;
            }

            throw $e; 
        }
    }
}