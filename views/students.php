<?php

function statusColor(string $status)
{
    return match ($status) {
        'AKTIF' => 'bg-green-600',
        'TIDAK AKTIF' => 'bg-red-500',
        default => 'bg-yellow-500'
    };
}

?>

<div class="flex flex-col gap-3">

    <!-- header page -->
    <div class="flex justify-between items-center p-2 ">
        <div class="flex flex-col gap-2">
            <span class="text-2xl font-semibold">Daftar Siswa</span>

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="#" class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Daftar Siswa</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-blue-600 hover:bg-[#4285F4]/90 hover:transition-colors hover:transition-all focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Siswa
        </button>

        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-[50rem] max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 bg-blue-600">
                        <div class="flex flex-col">
                            <h3 class="text-lg font-semibold text-white">
                                Tambah Siswa Baru
                            </h3>
                            <span class="text-sm text-white">Isi data dengan seksama dan validasi sebelum submit</span>
                        </div>
                        <button type="button" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="<?= url('students/store') ?>" method="POST">
                        <div class="grid gap-4 mb-4 grid-cols-2 border-b pb-4">
                            <div class="col-span-2">
                                <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 ">Nama panjang siswa</label>
                                <input type="text" name="fullname" id="fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Abu Lahab" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900 ">NISN</label>
                                <input type="number" name="nisn" id="nisn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="1293..." required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="classes" class="block mb-2 text-sm font-medium text-gray-900 ">Kelas Siswa</label>
                                <select name="class_id" id="classes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    <option selected="" disabled>Pilih Kelas</option>
                                    <?php foreach ($classes as $class): ?>
                                        <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?> (<?= htmlspecialchars($class['code']) ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-span-2 pt-2">
                                <span class="text-lg font-semibold text-gray-900 mb-3">Data Akun Siswa</span>
                                <div class="grid gap-4 mb-4 grid-cols-2 border-t pt-2">
                                    <div class="col-span-1">
                                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username Akun</label>
                                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Abu Lahab" required="">
                                    </div>
                                    <div class="col-span-1">
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password Akun</label>
                                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="1293..." required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-auto">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Submit Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- content page -->
    <div class="p-4 flex flex-col gap-2 rounded-lg border border-gray-200 bg-white shadow">

        <div class="flex justify-between items-center">
            <span class="font-semibold text-lg">Informasi Siswa</span>

            <div class="flex gap-1">
                <form class="max-w-lg">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border-2 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 focus:border-2" placeholder="Cari nama siswa" required />
                    </div>
                </form>

                <form class="max-w-2xl">
                    <select id="countries" class="bg-gray-50 border-2 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-56 p-2">
                        <option selected value="ALL">Semua</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </form>
            </div>
        </div>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-100" role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    <?= $_SESSION['flash_success'] ?>
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-200 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <?php unset($_SESSION['flash_success']); ?>
        <?php endif ?>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-white uppercase bg-blue-600">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Siswa
                        </th>
                        <th scope="col" class="px-6 py-3">
                            NISN
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jurusan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status Siswa
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Bergabung
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($students as $index => $student): ?>
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 text-gray-900 font-medium whitespace-nowrap">
                            <th class="px-6 py-4"><?= $index + 1 ?></th>
                            <th class="px-6 py-4"><?= htmlspecialchars($student['fullname']) ?></th>
                            <td class="px-6 py-4"><?= htmlspecialchars($student['nisn']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($student['nama_kelas']) ?></td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-medium px-3 py-1 rounded-lg text-white <?= statusColor($student['status']) ?>">
                                    <?= $student['status'] ?? 'BELUM DITAMBAHKAN' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4"><?= format_date($student['join_date'], false) ?></td>
                            <td class="px-6 py-4 flex gap-4 items-center">

                                <button onclick="editStudent(<?= $student['id'] ?>)" class="font-medium text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </button>

                                <button data-modal-target="delete-modal"
                                    data-modal-toggle="delete-modal"
                                    data-id="<?= $student['id'] ?>"
                                    data-name="<?= htmlspecialchars($student['fullname']) ?>"
                                    class="delete-btn text-red-600">

                                    <!-- icon delete -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m2-3h6a1 1 0 011 1v1H8V5a1 1 0 011-1z" />
                                    </svg>
                                </button>

                                <a href="<?= url('students/show', ['id' => $student['id']]) ?>" class="font-medium text-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <!-- Delete Confirmation Modal -->
            <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="delete-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500">
                                Hapus jenis siswa "<span id="delete-student-name" class="font-semibold"></span>"?
                            </h3>

                            <!-- Form untuk DELETE -->
                            <form id="delete-form" method="POST" action="<?= url('students/delete') ?>">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" id="delete-id">

                                <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Ya, hapus
                                </button>

                                <button data-modal-hide="delete-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                    Batalkan
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-[50rem] max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200 bg-blue-600">
                            <div class="flex flex-col">
                                <h3 class="text-lg font-semibold text-white">
                                    Edit Data Siswa
                                </h3>
                                <span class="text-sm text-white">Isi data dengan seksama dan validasi sebelum diedit</span>
                            </div>
                            <button type="button" class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <form id="editStudentForm" class="p-4 md:p-5">
                            <input type="hidden" name="edit_student_id" id="edit_student_id">
                            <input type="hidden" name="edit_user_id" id="edit_user_id">

                            <div class="grid gap-4 mb-4 grid-cols-3 border-b pb-4">
                                <div class="col-span-3">
                                    <label for="edit_fullname" class="block mb-2 text-sm font-medium text-gray-900">Nama panjang siswa</label>
                                    <input type="text" name="edit_fullname" id="edit_fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Abu Lahab" required>
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="edit_nisn" class="block mb-2 text-sm font-medium text-gray-900">NISN</label>
                                    <input type="number" name="edit_nisn" id="edit_nisn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="1293..." required>
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="edit_class_id" class="block mb-2 text-sm font-medium text-gray-900">Kelas Siswa</label>
                                    <select name="edit_class_id" id="edit_class_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        <?php foreach ($classes as $class): ?>
                                            <option value="<?= $class['id'] ?>">
                                                <?= htmlspecialchars($class['name']) ?>
                                                (<?= htmlspecialchars($class['code']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <label for="edit_status" class="block mb-2 text-sm font-medium text-gray-900">Status Siswa</label>
                                    <select name="edit_status" id="edit_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5" required>
                                        <option value="" disabled selected>Pilih Status</option>
                                        <option value="active">AKTIF</option>
                                        <option value="inactive">TIDAK AKTIF</option>
                                        <option value="graduate">LULUS</option>
                                    </select>
                                </div>

                                <div class="col-span-3 pt-2">
                                    <span class="text-lg font-semibold text-gray-900 mb-3">Data Akun Siswa</span>
                                    <div class="grid gap-4 mb-4 grid-cols-2 border-t pt-2">
                                        <div class="col-span-1">
                                            <label for="edit_username" class="block mb-2 text-sm font-medium text-gray-900">Username Akun</label>
                                            <input type="text" name="edit_username" id="edit_username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="username" required>
                                        </div>
                                        <div class="col-span-1">
                                            <label for="edit_password" class="block mb-2 text-sm font-medium text-gray-900">Password Akun</label>
                                            <input type="password" name="edit_password" id="edit_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Kosongkan jika tidak ingin mengubah">
                                            <span class="text-xs italic text-gray-400">* Password akan diperbarui jika diisi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex ">
                                <button type="submit" class="text-white inline-flex items-center bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ms-auto">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const BASE_URL = '<?= url("students/detail") ?>';
    let modal;

    document.addEventListener('DOMContentLoaded', function() {

        const modalEl = document.getElementById('edit-modal');

        if (!modalEl) {
            console.error('Modal element not found!');
            return;
        }

        modal = new Modal(modalEl, {
            closable: true,
            onHide: () => {
                clearForm();
            },
        });

        document.getElementById('editStudentForm').addEventListener('submit', handleSubmit);
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('delete-student-name').textContent = this.dataset.name;
            document.getElementById('delete-id').value = this.dataset.id;
        })
    })

    async function editStudent(id) {
        try {
            const url = `${BASE_URL}&student_id=${id}`;

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (result.success) {
                // Populate form dengan data
                populateForm(result.data);

                // Cek apakah modal sudah terinisialisasi
                if (!modal) {
                    console.error('Modal not initialized!');
                    alert('Modal belum siap. Silakan refresh halaman.');
                    return;
                }

                modal.show();
            } else {
                alert(result.message || 'Gagal mengambil data');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    function populateForm(data) {
        document.getElementById('edit_student_id').value = data.id || '';
        document.getElementById('edit_user_id').value = data.user_id || '';
        document.getElementById('edit_fullname').value = data.fullname || '';
        document.getElementById('edit_nisn').value = data.nisn || '';
        document.getElementById('edit_class_id').value = data.class_id || '';
        document.getElementById('edit_username').value = data.username || '';
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_status').value = data.status;

        console.log(data);
    }

    function clearForm() {
        document.getElementById('edit_student_id').value = '';
        document.getElementById('edit_user_id').value = '';
        document.getElementById('edit_fullname').value = '';
        document.getElementById('edit_nisn').value = '';
        document.getElementById('edit_class_id').value = '';
        document.getElementById('edit_username').value = '';
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_status').value = '';
    }

    function showSuccessAlert(message) {
        const alertEl = document.getElementById('success-alert');
        const msgEl = document.getElementById('success-message');

        msgEl.textContent = message;
        alertEl.classList.remove('hidden');

        // auto hide (optional)
        setTimeout(() => {
            alertEl.classList.add('hidden');
        }, 4000);
    }

    async function handleSubmit(e) {
        e.preventDefault();

        try {
            const url = '<?= url('students/update') ?>';
            const formData = new FormData(e.target);

            const response = await fetch(`${url}&student_id=${document.getElementById('edit_student_id').value}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                modal.hide();
                window.location.reload();

            } else {
                alert(result.message || 'Gagal mengupdate data');
            }

        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data');
        }
    }
</script>