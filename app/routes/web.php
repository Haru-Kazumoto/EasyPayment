<?php
/**
 * Cara buat route:
 * Router::get('nama-page-di-url', 'NamaController', 'namaMethodDiController');
 * Contoh:
 * Router::get('dashboard-admin', 'DashboardController', 'admin');
 * Maka ketika mengakses /?page=dashboard-admin
 * Maka akan memanggil method admin di DashboardController
 * Pastikan juga route nya di daftarin di public/index.php
 * Jangan lupa buat method nya di controller yang bersangkutan
 * dan buat view nya di folder views kalo perlu
 * 
 * semangat :)
 */

/**
 * Kalo mau buat metode post, delete, put, patch
 * gausah buat disini gapapa, langsung aja di view nya
 * 
 * caranya misal pake form, form kan ada method ya
 * kasih method nya POST/PUT/DELETE/PATCH  
 * terus action nya baru panggil fungsinya misal gw mau delete siswa dari StudentController pake fungsi delete
 * maka di form nya gini:
 * <form method="POST" action="/?page=students&method=delete&id=<?= $student['id'] ?>">
 * nah di route nya gausah di daftarin, langsung aja di StudentController buat method delete nya
 * 
 * contoh post ada di login.php, baca aja biar paham
 */

// Auth Routes
Router::get('login', 'AuthController', 'login');
Router::get('logout', 'AuthController', 'logout');

// Dashboard Routes
Router::get('dashboard-admin', 'DashboardController', 'admin')->middleware('AdminGuard');
Router::get('dashboard-student', 'DashboardController', 'student')->middleware('StudentGuard');

// Payment Routes
Router::get('bills', 'BillsController', 'index');

// Bill Types Routes
Router::get('bill-types', 'BillTypesController', 'index');
Router::get('bill-types/create', 'BillTypesController', 'create');

// Student Routes
Router::get('students', 'StudentController', 'index')->middleware('AdminGuard');
Router::get('classes', 'StudentController', 'classes');
Router::get('students/create', 'StudentController', 'create');

// Logs Routes
Router::get('payment-logs', 'LogController', 'index');

Router::get('classes', 'ClassesController', 'index');

