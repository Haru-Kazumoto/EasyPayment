<?php
class ClassesController extends Controller{
    public function index(){
        $classes= Classes::getAll();
        $this->view("classes", ['kelas' => $classes], "admin");
    }
}