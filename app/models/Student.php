<?php
class Student
{
    public static function getAllStudents()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT * FROM student");

        $query->execute();

        return $query->fetchAll();
    }

    public static function create($data)
    {
        $db = database::getInstance()->pdo();

        $query = $db->prepare("
                INSERT INTO student (fullname, nisn, join_date, user_id, class_id, status)
                VALUES (:fullname, :nisn, NOW(), :user_id, :class_id, 'active')
            ");

        return $query->execute([
            ':fullname'     => $data['fullname'],
            ':nisn'         => $data['nisn'],
            ':user_id'      => $data['user_id'],
            ':class_id'     => $data['class_id'],
        ]);
    }
}
