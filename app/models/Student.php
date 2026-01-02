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

}
