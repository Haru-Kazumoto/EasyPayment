<?php
class Student {
    public static function getAllStudents()
    {
        $db = Database::getInstance()->pdo();
        
        $query = $db->prepare("SELECT * FROM student");

        $query->execute();

        return $query->fetchAll();
    }
}