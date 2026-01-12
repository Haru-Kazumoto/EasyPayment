<?php
class Transaction
{
    public static function uploadPayment(array $data)
    {
        $db = Database::getInstance()->pdo();

        $trx_number = self::generateTrxNumber();

        $insertData = [
            'bill_id' => $data['bill_id'],
            'student_id' => $data['student_id'],
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'trx_number' => $trx_number,
        ];

        $sql = "INSERT INTO transaction (bill_id, student_id, amount, payment_method, trx_number, paid_at) 
                    VALUES (:bill_id, :student_id, :amount, :payment_method, :trx_number, now())";

        $stmt = $db->prepare($sql);
        $result = $stmt->execute($insertData);

        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    private static function generateTrxNumber()
    {
        $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);

        $trxNumber = '#payment-' . $randomNumber;

        $db = Database::getInstance()->pdo();
        $sql = "SELECT COUNT(*) as count FROM transaction WHERE trx_number = :trx_number";
        $stmt = $db->prepare($sql);
        $stmt->execute(['trx_number' => $trxNumber]);
        $result = $stmt->fetch();

        if ($result['count'] > 0) {
            return self::generateTrxNumber();
        }

        return $trxNumber;
    }

    public static function getByBillId($bill_id)
    {
        try {
            $db = Database::getInstance()->pdo();

            $sql = "SELECT * FROM transaction
                    WHERE bill_id = :bill_id 
                    ORDER BY paid_at DESC";

            $stmt = $db->prepare($sql);
            $stmt->execute(['bill_id' => $bill_id]);

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Get Transactions Error: " . $e->getMessage());
            return [];
        }
    }

    public static function getTotalPaid($bill_id, $student_id)
    {
        try {
            $db = Database::getInstance()->pdo();

            $sql = "SELECT COALESCE(SUM(amount), 0) as total 
                    FROM transaction
                    WHERE bill_id = :bill_id AND student_id = :student_id";

            $stmt = $db->prepare($sql);
            $stmt->execute(['bill_id' => $bill_id, 'student_id' => $student_id]);
            $result = $stmt->fetch();

            return (float) $result['total'];
        } catch (\Exception $e) {
            error_log("Get Total Paid Error: " . $e->getMessage());
            return 0;
        }
    }

    public static function getTransactionsByBillAndStudent(int $bill_id, int $student_id)
    {
        $db = Database::getInstance()->pdo();

        $sql = "
            SELECT
                t.amount,
                t.paid_at,
                t.trx_number,
                t.approved_at,
                t.approved_by,
                t.payment_method,

                CASE
                    WHEN t.approved_at IS NULL THEN 'PENDING'
                    ELSE 'APPROVED'
                END AS status,

                CASE
                    WHEN t.approved_at IS NULL THEN 'yellow'
                    ELSE 'green'
                END AS status_color

            FROM transaction t
            WHERE t.bill_id = :bill_id
              AND t.student_id = :student_id

            ORDER BY t.paid_at DESC
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':bill_id'   => $bill_id,
            ':student_id' => $student_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
                SELECT
                    tx.id,
                    tx.amount,
                    tx.paid_at,
                    tx.trx_number,
                    tx.payment_method,
                    s.fullname as student_name,
                    b.title as bill_title,
                    case
                        when tx.approved_by IS NULL then 'pending'
                        ELSE 'approved'
                    END AS status
                FROM transaction tx
                INNER JOIN student s ON s.id = tx.student_id
                INNER JOIN bills b ON b.id = tx.bill_id
                ORDER BY tx.paid_at DESC
            ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTransactionByStudents(int $student_id)
    {
        $db = Database::getInstance()->pdo();

        $sql = "SELECT
                tx.*,
                case
                    when tx.approved_by IS NULL then 'PENDING'
                    ELSE 'APPROVED'
                END AS status
            FROM transaction tx WHERE student_id = :student_id
            ORDER BY tx.paid_at DESC;
        ";

        $query = $db->prepare($sql);

        $query->execute([':student_id' => $student_id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function approving(int $transaction_id, int $admin_id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("UPDATE transaction SET approved_at = NOW(), approved_by = :admin_id WHERE id = :transaction_id");

        return $query->execute([
            ':admin_id' => $admin_id,
            ':transaction_id' => $transaction_id
        ]);
    }

    public static function sumAmount(string $status = 'approved' | 'pending')
    {
        $db = Database::getInstance()->pdo();

        $stmt = $status === 'approved' ? 'IS NOT NULL' : 'IS NULL';

        $query = $db->prepare("SELECT SUM(tx.amount) as total FROM transaction tx WHERE tx.approved_by $stmt");

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function countPending()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT COUNT(tx.id) as total FROM transaction tx WHERE tx.approved_by IS NULL");

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function count()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT COUNT(tx.id) as total FROM transaction tx");

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function monthlyTransaction()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare('
            SELECT SUM(tx.amount) as total
            FROM transaction tx
            WHERE MONTH(tx.paid_at) = MONTH(NOW())
            AND YEAR(tx.paid_at) = YEAR(NOW())
        ');

        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
