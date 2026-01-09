<?php

class StudentBills{
    public static function register(array $data)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            INSERT INTO student_bills (student_id, bill_id, register_at)
            VALUES (:student_id, :bill_id, NOW())
        ");

        return $query->execute([
            ':student_id' => $data['student_id'],
            ':bill_id'    => $data['bill_id'],
        ]);
    }
}