<?php
class Bill
{

    public static function getAll()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->query('SELECT b.*, bt.name AS type_name FROM bills b INNER JOIN bills_type bt ON b.type_id = bt.id');

        $query->execute();

        return $query->fetchAll();
    }

    public static function create(array $data)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            INSERT INTO bills (title, subtitle, type_id, admin_id, amount, due_date, academic_year, created_at, updated_at)
            VALUES (:title, :subtitle, :type_id, :admin_id, :amount, :due_date, :academic_year, now(), now())
        ");

        return $query->execute([
            ':title'            => $data['title'],
            ':subtitle'         => $data['subtitle'],
            ':type_id'          => $data['type_id'],
            ':admin_id'         => $data['admin_id'],
            ':amount'           => $data['amount'],
            ':due_date'         => $data['due_date'],
            ':academic_year'    => $data['academic_year']
        ]);
    }

    public static function findOne(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare('SELECT b.*, bt.name AS type_name FROM bills b INNER JOIN bills_type bt ON b.type_id = bt.id WHERE b.id = :bill_id');

        $query->execute([
            ':bill_id' => $id
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function update(array $data, int $id)
    {
        $db = Database::getInstance()->pdo();

        $updateFields = [];
        $params = ['id' => $id];

        // ===== Field utama =====
        if (isset($data['title'])) {
            $updateFields[] = "title = :title";
            $params['title'] = $data['title'];
        }

        if (isset($data['subtitle'])) {
            $updateFields[] = "subtitle = :subtitle";
            $params['subtitle'] = $data['subtitle'];
        }

        if (isset($data['type_id'])) {
            $updateFields[] = "type_id = :type_id";
            $params['type_id'] = $data['type_id'];
        }

        if (isset($data['amount'])) {
            $updateFields[] = "amount = :amount";
            $params['amount'] = $data['amount'];
        }

        if (isset($data['due_date'])) {
            $updateFields[] = "due_date = :due_date";
            $params['due_date'] = $data['due_date'];
        }

        if (isset($data['academic_year'])) {
            $updateFields[] = "academic_year = :academic_year";
            $params['academic_year'] = $data['academic_year'];
        }

        // updated_at otomatis
        $updateFields[] = "updated_at = now()";

        if (empty($updateFields)) {
            return true;
        }

        $sql = "UPDATE bills SET " . implode(', ', $updateFields) . " WHERE id = :id";

        $query = $db->prepare($sql);

        return $query->execute($params);
    }

    public static function delete(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare(
            "DELETE FROM bills WHERE id = :id"
        );

        return $query->execute([
            ':id' => $id
        ]);
    }

    public static function getStudentsByBill(int $billId): array
{
    $db = Database::getInstance()->pdo();

    $query = $db->prepare(
        'SELECT 
            s.id,
            s.fullname,
            s.nisn
        FROM student_bills sb
        INNER JOIN student s 
            ON sb.student_id = s.id
        WHERE sb.bill_id = :bill_id'
    );

    $query->execute([
        ':bill_id' => $billId
    ]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

}
