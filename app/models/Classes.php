<?php
class Classes{
    public static function getAll(){
        $db=Database::getInstance()->pdo();
        $query = $db->query('SELECT * FROM classes');
        $query->execute();
        return $query->fetchAll();
    }
}