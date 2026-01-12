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

    public static function getLatest()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->query('SELECT * FROM bills b ORDER BY b.created_at DESC LIMIT 5');

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

        $query = $db->prepare("
            SELECT b.*, bt.name AS type_name FROM bills b INNER JOIN bills_type bt ON b.type_id = bt.id WHERE b.id = :bill_id
        ");

        $query->execute([
            ':bill_id' => $id
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function findOneWithPaymentStatus(int $bill_id, int $student_id)
    {
        $db = Database::getInstance()->pdo();

        $sql = "
            SELECT
                b.id AS bill_id,
                b.title,
                b.subtitle,
                b.amount,
                b.due_date,
                b.academic_year,
                bt.name as type_name,

                sb.id AS student_bill_id,

                CAST(COALESCE(SUM(t.amount), 0) AS SIGNED) AS total_paid,

                CASE
                    WHEN COALESCE(SUM(t.amount), 0) >= b.amount THEN 'LUNAS'

                    WHEN sb.id IS NOT NULL
                        AND NOW() >= b.due_date
                        AND COALESCE(SUM(t.amount), 0) < b.amount
                    THEN 'JATUH TEMPO'

                    WHEN sb.id IS NULL THEN 'BELUM TEREGISTRASI'

                    WHEN COALESCE(SUM(t.amount), 0) = 0 THEN 'BELUM TERBAYAR'

                    WHEN COALESCE(SUM(t.amount), 0) < b.amount THEN 'PEMBAYARAN BERTAHAP'

                    ELSE 'UNKNOWN'
                END AS status,

                CASE
                    WHEN COALESCE(SUM(t.amount), 0) >= b.amount THEN 'green'

                    WHEN sb.id IS NOT NULL
                        AND NOW() >= b.due_date
                        AND COALESCE(SUM(t.amount), 0) < b.amount
                    THEN 'red'

                    WHEN sb.id IS NULL THEN 'yellow'

                    WHEN COALESCE(SUM(t.amount), 0) = 0 THEN 'orange'

                    WHEN COALESCE(SUM(t.amount), 0) < b.amount THEN 'blue'

                    ELSE 'gray'
                END AS color

            FROM bills b

            LEFT JOIN student_bills sb
                ON sb.bill_id = b.id
                AND sb.student_id = :student_id

            LEFT JOIN transaction t
                ON t.bill_id = b.id
                AND t.student_id = :student_id
                AND t.approved_at IS NOT NULL

            INNER JOIN bills_type as bt
                ON bt.id = b.type_id           

            WHERE b.id = :bill_id

            GROUP BY
                b.id,
                sb.id,
                bt.id
            LIMIT 1
        ";

        $query = $db->prepare($sql);
        $query->execute([
            'bill_id'    => $bill_id,
            'student_id' => $student_id
        ]);

        return $query->fetch(\PDO::FETCH_ASSOC);
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

    public static function getAllWithStudentInformation(int $student_id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            SELECT
                b.id AS bill_id,
                b.title,
                b.subtitle,
                b.amount AS bill_amount,
                b.due_date,
                b.academic_year,

                sb.id AS student_bill_id,

                CAST(COALESCE(SUM(t.amount), 0) AS SIGNED) AS total_paid,

                CASE
                    WHEN COALESCE(SUM(t.amount), 0) >= b.amount THEN 'LUNAS'

                    WHEN sb.id IS NOT NULL
                        AND NOW() >= b.due_date
                        AND COALESCE(SUM(t.amount), 0) < b.amount
                    THEN 'JATUH TEMPO'

                    WHEN sb.id IS NULL THEN 'BELUM TEREGISTRASI'

                    WHEN COALESCE(SUM(t.amount), 0) = 0 THEN 'BELUM TERBAYAR'

                    WHEN COALESCE(SUM(t.amount), 0) < b.amount THEN 'PEMBAYARAN BERTAHAP'

                    ELSE 'UNKNOWN'
                END AS status,

                CASE
                    WHEN COALESCE(SUM(t.amount), 0) >= b.amount THEN 'green'

                    WHEN sb.id IS NOT NULL
                        AND NOW() >= b.due_date
                        AND COALESCE(SUM(t.amount), 0) < b.amount
                    THEN 'red'

                    WHEN sb.id IS NULL THEN 'yellow'

                    WHEN COALESCE(SUM(t.amount), 0) = 0 THEN 'orange'

                    WHEN COALESCE(SUM(t.amount), 0) < b.amount THEN 'blue'

                    ELSE 'gray'
                END AS color

            FROM bills b

            LEFT JOIN student_bills sb
                ON sb.bill_id = b.id
                AND sb.student_id = :student_id

            LEFT JOIN transaction t
                ON t.bill_id = b.id
                AND t.student_id = :student_id
                AND t.approved_at IS NOT NULL

            GROUP BY
                b.id,
                sb.id 
            ORDER BY
                b.due_date ASC;
        ");

        $query->execute([
            ':student_id' => $student_id
        ]);

        return $query->fetchAll();
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

    public static function sumAmount()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare('SELECT SUM(b.amount) as total FROM bills b');

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
