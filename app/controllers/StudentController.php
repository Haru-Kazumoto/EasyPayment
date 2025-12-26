<?php
class StudentController extends Controller {
    public function index() 
    {
        $students = Student::getAllStudents(); // panggil model

        $this->view('students', ['students' => $students], 'admin');
    }
}