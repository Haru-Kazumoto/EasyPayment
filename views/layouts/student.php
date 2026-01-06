<?php
function isActiveStudent($page)
{
    $currentPage = $_GET['page'] ?? 'dashboard-student';
    return $currentPage === $page
        ? 'bg-blue-200 text-blue-700'
        : 'text-gray-700 hover:bg-gray-100 hover:text-blue-600';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - EasyPayment</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center">
                    <a href="/?page=dashboard-student" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">EP</span>
                        </div>
                        <span class="text-xl font-semibold text-gray-800 hidden sm:block">EasyPayment</span>
                    </a>
                </div>


                <div class="hidden md:flex items-center space-x-1">
                    <a href="<?= url('dashboard-student') ?>"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('dashboard-student') ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                    </a>
                    <a href="<?= url('bills') ?>"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('bills') ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Pembayaran</span>
                        </div>
                    </a>
                    <a href="#"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('student-history') ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Riwayat</span>
                        </div>
                    </a>
                    <a href="/?page=student-profile"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('student-profile') ?>">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Profile</span>
                        </div>
                    </a>
                </div>


                <div class="flex items-center space-x-3">


                    <div class="relative">
                        <button type="button"
                            class="flex items-center space-x-1 text-sm bg-gray-100 rounded-lg p-2 hover:bg-gray-200 transition-colors duration-200"
                            id="user-menu-button"
                            aria-expanded="false"
                            data-dropdown-toggle="user-dropdown">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">
                                <?= strtoupper(substr($_SESSION['user']['fullname'] ?? 'S', 0, 1)) ?>
                            </div>
                            <span class="hidden sm:block font-medium text-gray-700">
                                <?= $_SESSION['user']['fullname'] ?? 'Siswa' ?>
                            </span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                            </svg>
                        </button>


                        <div id="user-dropdown" class="hidden z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg w-48">
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900 font-semibold"><?= $_SESSION['user']['fullname'] ?? 'Siswa' ?></span>
                                <span class="block text-sm text-gray-500 truncate">NISN: <?= $_SESSION['user']['nisn'] ?? '-' ?></span>
                            </div>
                            <ul class="py-2">
                                <li>
                                    <a href="<?= url('logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span>Logout</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <button type="button"
                        class="md:hidden inline-flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100"
                        aria-controls="mobile-menu"
                        data-collapse-toggle="mobile-menu">
                        <span class="sr-only">Open menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>


        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-50 border-t border-gray-200">
                <a href="/?page=dashboard-student"
                    class="block px-3 py-2 text-base font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('dashboard-student') ?>">
                    Dashboard
                </a>
                <a href="/?page=student-bills"
                    class="block px-3 py-2 text-base font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('student-bills') ?>">
                    Pembayaran
                </a>
                <a href="/?page=student-history"
                    class="block px-3 py-2 text-base font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('student-history') ?>">
                    Riwayat
                </a>
                <a href="/?page=student-profile"
                    class="block px-3 py-2 text-base font-medium rounded-lg transition-colors duration-200 <?= isActiveStudent('student-profile') ?>">
                    Profile
                </a>
            </div>
        </div>
    </nav>


    <main class="pt-20 pb-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?= $content ?>
        </div>
    </main>


    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-center text-sm text-gray-500">
                © 2024 EasyPayment. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>