<?php
class Classes{
    public static function getAll(){
        $db=Database::getInstance()->pdo();
        $query = $db->query('SELECT * FROM classes');
        $query->execute();
        return $query->fetchAll();
    }

    public static function create(array $data){
    {
        try {
            $db = Database::getInstance()->pdo();
    
            $query = $db->prepare('INSERT INTO classes (code, name) VALUES (:code, :name)');
    
            $result = $query->execute([
                ':code' => $data['code'],
                ':name' => $data['name'],
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
}