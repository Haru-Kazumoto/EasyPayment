<?php
class StudentController extends Controller {
    public function index() 
    {
        $students = Student::getAllStudents();

        $this->view('students', [
            'nama' => 'ferdian'
        ], 'admin');
    }
}