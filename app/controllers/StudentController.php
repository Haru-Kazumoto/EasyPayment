<?php
class StudentController extends Controller {
    public function index() 
    {
       
        $students = Student::getAllStudents();

        $this->view('students', ['students' => $students], 'admin');
    }

    public function create() {
        $this->view('create-students', [], 'admin');
    }

    public function store() {
        $error_code = $_SESSION['error_code'] ?? null;
        unset($_SESSION['error_code']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fullname'       => $_POST['fullname'] ?? '',
                'nisn'           => $_POST['nisn'] ?? '',
                'join_date'      => $_POST['join_date'] ?? '',
                'user_id'        => $_POST['user_id'] ?? ''  ,
                'class_id'       => $_POST['class_id'] ?? '',
                'status'         => $_POST['status'] ?? ''
            ];

        $response = student::insert($data);
        if ($response === false) {
            $_SESSION['error_code'] = 'Gagal menyimpan data';
            $_SESSION['old_data'] = $data;
            header('Location: ' . url('create-students/create'));
            exit;
        }

        header('Location: ' . url('create-students'));
        exit;

        }

        $this->view('create-students', [
            'error_code' => $error_code,
            'old_data' => $_SESSION['old_data'] ?? []
        ], 'admin');
        
        
        unset($_SESSION['old_data']);
    }
}   