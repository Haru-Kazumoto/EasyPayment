<?php
class Student
{
    public static function getAllStudents()
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            SELECT 
                s.id,
                s.fullname,
                s.nisn,
                s.join_date,
                c.name AS nama_kelas,
                CASE 
                    WHEN s.status = 'active' THEN 'AKTIF'
                    WHEN s.status = 'inactive' THEN 'TIDAK AKTIF'
                    WHEN s.status = 'graduate' THEN 'SUDAH LULUS'
                END AS status
            FROM student s
            LEFT JOIN classes c ON s.class_id = c.id
            ORDER BY s.id DESC
        ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findOneWithAccountRelation(int $student_id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            SELECT 
                s.id,
                s.fullname,
                s.nisn,
                s.status,
                s.user_id,
                s.class_id,
                u.username
            FROM student s
            LEFT JOIN users u ON u.id = s.user_id
            WHERE s.id = :student_id;
        ");

        $query->execute([':student_id' => $student_id]);

        $studentWithAccount = $query->fetch(PDO::FETCH_ASSOC);

        return $studentWithAccount;
    }

    public static function findOne(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("SELECT * FROM student WHERE id = :id LIMIT 1");

        $query->execute([':id' => $id]);

        $student = $query->fetch(PDO::FETCH_ASSOC);

        return $student;
    }

    public static function create($data)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            INSERT INTO student (fullname, nisn, join_date, user_id, class_id, status)
            VALUES (:fullname, :nisn, NOW(), :user_id, :class_id, :status)
        ");

        return $query->execute([
            ':fullname' => $data['fullname'],
            ':nisn'     => $data['nisn'],
            ':user_id'  => $data['user_id'],
            ':class_id' => $data['class_id'],
            ':status'   => 'active'
        ]);
    }

    public static function delete(int $id)
    {
        $db = Database::getInstance()->pdo();

        $stmt = $db->prepare("SELECT user_id FROM student WHERE id = :id");

        $stmt->execute([':id' => $id]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student) {
            // ini siswanya
            $query = $db->prepare("DELETE FROM student WHERE id = :id");
            $query->execute([':id' => $id]);

            // ini yg ada di table user yang terkait di user_id
            $queryUser = $db->prepare("DELETE FROM users WHERE id = :user_id");
            $queryUser->execute([':user_id' => $student['user_id']]);

            return true;
        }

        return false;
    }

    public static function update(array $data, int $id)
    {
        $db = Database::getInstance()->pdo();

        // Cek apakah student exists
        $findData = $db->prepare("SELECT * FROM student WHERE id = :id");
        $findData->execute([':id' => $id]);
        $existingStudent = $findData->fetch(PDO::FETCH_ASSOC);

        if (!$existingStudent) {
            return false;
        }

        // Cek duplicate NISN (kecuali student itu sendiri)
        if (!empty($data['nisn']) && $data['nisn'] !== $existingStudent['nisn']) {
            $checkNisn = $db->prepare("SELECT id FROM student WHERE nisn = :nisn AND id != :id");
            $checkNisn->execute([
                ':nisn' => $data['nisn'],
                ':id' => $id
            ]);

            if ($checkNisn->fetch()) {
                throw new Exception("NISN sudah digunakan");
            }
        }

        // Build update query dynamically
        $updateFields = [];
        $params = [':id' => $id];

        if (isset($data['fullname'])) {
            $updateFields[] = "fullname = :fullname";
            $params[':fullname'] = $data['fullname'];
        }

        if (isset($data['nisn'])) {
            $updateFields[] = "nisn = :nisn";
            $params[':nisn'] = $data['nisn'];
        }

        if (isset($data['class_id'])) {
            $updateFields[] = "class_id = :class_id";
            $params[':class_id'] = $data['class_id'];
        }

        if (isset($data['status'])) {
            $updateFields[] = "status = :status";
            $params[':status'] = $data['status'];
        }

        // Jika tidak ada yang diupdate, return true
        if (empty($updateFields)) {
            return true;
        }

        // PENTING: TAMBAHKAN WHERE CLAUSE!
        $query = $db->prepare("UPDATE student SET " . implode(', ', $updateFields) . " WHERE id = :id");

        return $query->execute($params);
    }

    // Method tambahan untuk get by id dengan user data
    public static function getById(int $id)
    {
        $db = Database::getInstance()->pdo();

        $query = $db->prepare("
            SELECT s.*, c.name as class_name, c.code as class_code, u.username, u.id as user_id
            FROM student s
            LEFT JOIN classes c ON s.class_id = c.id
            LEFT JOIN users u ON s.user_id = u.id
            WHERE s.id = :id
        ");

        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
