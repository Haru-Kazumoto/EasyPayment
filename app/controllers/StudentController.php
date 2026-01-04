<?php
require '../app/helpers/validate_id.php';

class StudentController extends Controller
{
    public function index()
    {
        $this->view('students', [
            'students' => Student::getAllStudents(),
            'classes' => Classes::getAll()
        ], 'admin');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account_data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'fullname' => $_POST['fullname'],
                'isAdmin'  => 0,
            ];

            $created_account_id = User::create($account_data);

            $student_data = [
                'fullname'       => $_POST['fullname'] ?? '',
                'nisn'           => $_POST['nisn'] ?? '',
                // 'join_date'      => $_POST['join_date'] ?? '',
                'user_id'        => $created_account_id,
                'class_id'       => $_POST['class_id'] ?? '',
                // 'status'         => $_POST['status'] ?? ''
            ];

            Student::create($student_data);

            $_SESSION['flash_success'] = 'Berhasil menambahkan data!';

            header('Location: ' . url('students'));
            exit;
        }
    }

    public function show()
    {
        $student_id = $_GET['student_id'];

        try {
            if (!$student_id) {
                $this->error('ID Tidak ditemukan!', null, 400);
            }

            $student_data = Student::findOneWithAccountRelation($student_id);

            if (!$student_data) {
                $this->error('Data tidak ditemukan!', null, 400);
            }

            $this->success('Data berhasil diambil', $student_data);
        } catch (\Exception $e) {
            $this->error('Gagal mengambil data: ' . $e->getMessage(), null, 500);
        }
    }

    public function getDetail()
    {
        try {
            $id = $_GET['student_id'] ?? null;

            if (!$id) {
                $this->error('ID siswa tidak ditemukan', null, 400);
            }

            $student = Student::getById($id);

            if (!$student) {
                $this->error('Siswa tidak ditemukan', null, 404);
            }

            $this->success('Data berhasil diambil', $student);
        } catch (Exception $e) {
            $this->error('Gagal mengambil data: ' . $e->getMessage(), null, 500);
        }
    }

    public function update()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->error('Method not allowed', null, 405);
            }

            // Ambil student_id dari POST (bukan GET!)
            $student_id = $_GET['student_id'] ?? null;

            if (!$student_id) {
                $this->error('ID siswa tidak ditemukan', null, 400);
            }

            // Validasi input
            $errors = [];

            $fullname = $_POST['edit_fullname'] ?? null;
            $nisn = $_POST['edit_nisn'] ?? null;
            $class_id = $_POST['edit_class_id'] ?? null;
            $username = $_POST['edit_username'] ?? null;
            $password = $_POST['edit_password'] ?? null; // Boleh kosong

            if (empty($fullname)) $errors['fullname'] = 'Nama harus diisi';
            if (empty($nisn)) $errors['nisn'] = 'NISN harus diisi';
            if (empty($class_id)) $errors['class_id'] = 'Kelas harus dipilih';
            if (empty($username)) $errors['username'] = 'Username harus diisi';

            if (!empty($errors)) {
                $this->error('Validasi gagal', $errors, 422);
            }

            // Get student data untuk ambil user_id
            $student = Student::getById($student_id);

            if (!$student) {
                $this->error('Data siswa tidak ditemukan', null, 404);
            }

            // Gunakan database transaction untuk memastikan data konsisten
            $db = Database::getInstance()->pdo();
            $db->beginTransaction();

            try {
                // Update user data
                $user_data = [
                    'username' => $username
                ];

                // Hanya tambahkan password jika diisi
                if (!empty($password)) {
                    die('ada password: ' . $password);
                    $user_data['password'] = $password;
                }

                $user_res = User::update($user_data, $student['user_id']);

                if (!$user_res) {
                    throw new Exception('Gagal memperbarui data pengguna');
                }

                // Update student data
                $student_data = [
                    'fullname'  => $fullname,
                    'nisn'      => $nisn,
                    'class_id'  => $class_id,
                ];

                // Tambahkan status jika ada
                if (isset($_POST['edit_status'])) {
                    $student_data['status'] = $_POST['edit_status'];
                }

                $student_res = Student::update($student_data, $student_id);

                if (!$student_res) {
                    throw new Exception('Gagal memperbarui data siswa');
                }

                // Commit transaction
                $db->commit();

                $_SESSION['flash_success'] = 'Berhasil memperbarui data!';

                $this->success('Berhasil memperbarui data siswa');
            } catch (Exception $e) {
                // Rollback jika ada error
                $db->rollBack();
                throw $e;
            }
        } catch (Exception $e) {
            $this->error($e->getMessage(), null, 500);
        }
    }

    /**
     * silahkan lanjutkan untuk update dan delete
     * update dan delete ini harus passing id dari data yang dipilih
     * 
     * logika update:
     * ambil data dari id yang dipilih, fetch datanya, passing data lama ke view
     * kalau di submit pakai PATCH aja, jangan PUT
     * 
     * logika delete: 
     * delete data dari id yang dipilih, langsung DELETE aja gapapa.
     */

    // logika update

    // logika delete, gak perlu fetch data karna langsung passing id
    public function delete()
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        if ($method !== 'DELETE') {
            header('Location: ' . url('students'));
            exit;
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            header('Location: ' . url('students'));
            exit;
        }

        Student::delete($id);

        $_SESSION['flash_success'] = "Data berhasil dihapus";

        header('Location: ' . url('students'));
        exit;
    }
}
