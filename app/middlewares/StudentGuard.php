<?php
class StudentGuard extends Middleware
{
    public function handle()
    {
        if ((boolean) $_SESSION['user']['is_admin']) {
            // set flash messagenya bro
            $_SESSION['error'] = 'Akses ditolak. Hanya untuk student.';

            header('Location: ?page=dashboard-admin');
            exit;
            return false;
        }
        
        return true;
    }
}