<?php
class Student
{

    /**
     * TASK BUAT ELDEN: 
     * ambil data siswa join ke table kelas,
     * tampilkan data : 
     * id siswa
     * nama siswa
     * nisn 
     * jurusan
     * nama kelas siswa
     * status ( untuk status di convert ya)
     * active => AKTIF
     * inactive => TIDAK AKTIF
     * graduate => SUDAH LULUS
     */
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
}
