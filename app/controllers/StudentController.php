<?php
class StudentController extends Controller
{
    public function index()
    {
        $students = Student::getAllStudents();
        $classes = Classes::getAll();

        $this->view('students', [
            'students' => $students,
            'classes' => $classes
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

            header('Location: ' . url('students'));
            exit;
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

    // mengambil data lama untuk di fetch ke view
    public function edit() {}

    // logika update
    public function update() {}

    // logika delete, gak perlu fetch data karna langsung passing id
   public function delete() 
    {
        if (isset($_GET['id'])) {
        Student::delete($_GET['id']);
    }

    header('Location: ' . url('students'));
    exit;
        
    }

}   
