<?php
class BillTypes {
    public static function getAll()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->query('SELECT * FROM bills_type');
        $query->execute();

        return $query->fetchAll();
    }
}