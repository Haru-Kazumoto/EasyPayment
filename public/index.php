<?php
require '../app/helpers/session.php';
require '../app/core/Database.php';
require '../app/core/Controller.php';

spl_autoload_register(function ($class) {
    foreach (['controllers', 'models'] as $dir) {
        $path = "../app/$dir/$class.php";
        if (file_exists($path)) require $path;
    }
});

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'bills':
        (new PaymentController)->index();
        break;
    default:
        (new AuthController)->login();
}
