<?php
class AdminGuard extends Middleware
{
    public function handle()
    {
        if ((boolean) !$_SESSION['user']['is_admin']) {
            // set flash messagenya bro
            $_SESSION['error'] = 'Akses ditolak. Hanya untuk admin.';

            header('Location: ?page=dashboard-student');
            exit;
            return false;
        }
        return true;
    }
}
