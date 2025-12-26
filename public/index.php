<?php
require_once '../app/config/config.php';
require '../app/helpers/session.php';
require '../app/core/Database.php';
require '../app/core/Controller.php';
require '../app/core/Router.php';
require '../app/core/Middleware.php';

spl_autoload_register(function ($class) {
    foreach (['controllers', 'models','middlewares'] as $dir) {
        $path = "../app/$dir/$class.php";
        if (file_exists($path)) require $path;
    }
});

$page = $_GET['page'] ?? 'login';

// load routes
require '../app/routes/web.php';

// routing nya panggil disini ngab, kalo bingung baca aja di core/Router.php
Router::dispatch();