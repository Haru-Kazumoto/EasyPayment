<?php
class Transaction
{
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
}
