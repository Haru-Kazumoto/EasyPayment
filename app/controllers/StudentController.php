<?php
class StudentController extends Controller {
    public function index() 
    {
        $students = Student::getAllStudents();

        $this->view('student-list', [
            'students' => $students
        ], 'student');
    }

    admin:
    username : admin
    asspwrd: admin123

    student: 
    username : student
    asspwrd: admin123
}