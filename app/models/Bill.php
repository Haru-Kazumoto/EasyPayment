<?php
class Bill {

    public static function getByStudent($studentId) {

        $db = Database::getInstance()->pdo();
        $stmt = $db->prepare("SELECT * FROM bills WHERE student_id = ?");
        $stmt->execute([$studentId]);

        return $stmt->fetchAll();
    }
}
