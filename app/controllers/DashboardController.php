<?php
class DashboardController extends Controller 
{
    public function admin() 
    {
        require_auth();
        $this->view('dashboard-admin', [],'admin');
    }

    public function student() 
    {
        require_auth();
        $this->view('dashboard-student', [], 'student');
    }
}