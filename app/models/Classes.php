<?php
class Classes
{
    public static function getAll()
    {
        $db = Database::getInstance()->pdo();
        $query = $db->query('SELECT * FROM classes');
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
}
