<div class="flex flex-col gap-3">
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-2">
            <span class="text-2xl font-semibold">Daftar Tagihan</span>

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="<?= url('dashboard-admin') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600">
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Daftar Tagihan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <a href="<?= url('bills/create') ?>" class="text-white bg-blue-600 hover:bg-blue-700 hover:transition-colors focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Tagihan
        </a>
    </div>

    <div class="p-4 flex flex-col gap-2 rounded-lg border border-gray-200 bg-white shadow">

        <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-lg">Informasi Tagihan</span>

            <div class="flex gap-1">
                <form class="max-w-lg">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border-2 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 focus:border-2" placeholder="Cari nama tagihan..." required />
                    </div>
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
                        <th scope="col" class="px-6 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Tagihan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Nominal
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Jatuh Tempo
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Tahun Ajaran
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Siswa Terkait
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bills)): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-2 font-medium">Tidak ada data tagihan</p>
                                <p class="text-xs">Silakan tambahkan tagihan baru</p>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($bills as $index => $bill): ?>
                            <tr class="bg-white border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium text-gray-900">
                                    <?= $index + 1 ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-900"><?= htmlspecialchars($bill['title']) ?></span>
                                        <?php if (!empty($bill['subtitle'])): ?>
                                            <span class="text-xs text-gray-500"><?= htmlspecialchars($bill['subtitle']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= htmlspecialchars($bill['type_name']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-semibold text-gray-900">
                                    Rp <?= number_format($bill['amount'], 0, ',', '.') ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php
                                    $dueDate = new DateTime($bill['due_date']);
                                    $today = new DateTime();
                                    $isOverdue = $dueDate < $today;
                                    ?>
                                    <span class="text-gray-700">
                                        <?= $dueDate->format('d M Y') ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-700">
                                    <?= htmlspecialchars($bill['academic_year']) ?>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-gray-800 font-medium">
                                        0
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="<?= url('bills/edit', ['id' => $bill['id']]) ?>" class="text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 p-2 rounded-lg transition-colors" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <button type="button"
                                            data-modal-target="delete-modal"
                                            data-modal-toggle="delete-modal"
                                            data-id="<?= $bill['id'] ?>"
                                            data-name="<?= htmlspecialchars($bill['title']) ?>"
                                            class="delete-btn text-red-600 hover:text-red-800 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
                                Hapus tagihan "<span id="delete-item-name" class="font-semibold"></span>"?
                            </h3>

                            <!-- Form untuk DELETE -->
                            <form id="delete-form" method="POST" action="<?= url('bills/delete') ?>">
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
        </div>
    </div>
</div>

<script>
    // Handle delete button click
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('delete-item-name').textContent =
                this.dataset.name;

            document.getElementById('delete-id').value =
                this.dataset.id;
        });
    });
</script>