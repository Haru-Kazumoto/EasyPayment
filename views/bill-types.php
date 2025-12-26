<div class="flex flex-col gap-3">

    <!-- header page -->
    <div class="flex justify-between items-center p-2 ">
        <div class="flex flex-col gap-2">
            <span class="text-2xl font-semibold">Daftar Jenis Tagihan</span>

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="<?= url('dashboard-admin') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Jenis Tagihan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <button type="button" class="text-white bg-blue-600 hover:bg-[#4285F4]/90 hover:transition-colors hover:transition-all focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Jenis Tagihan
        </button>
    </div>

    <!-- content page -->
    <div class="p-4 flex flex-col gap-2 rounded-lg border border-gray-200 bg-white shadow">

        <div class="flex justify-between items-center">
            <span class="font-semibold text-lg">Informasi Jenis Tagihan</span>

            <div class="flex gap-1">
                <form class="max-w-lg">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border-2 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 focus:border-2" placeholder="Cari nama jenis tagihan" required />
                    </div>
                </form>
            </div>
        </div>

        <div class="relative overflow-x-auto sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Jenis Tagihan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kode Jenis Tagihan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Deskripsi Tagihan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bill_types)): ?>
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 text-gray-900 font-medium whitespace-nowrap">
                            <td colspan="5" class="px-6 py-4 text-center">
                                Jenis tagihan tidak tersedia.
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($bill_types as $index => $type): ?>
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 text-gray-900 font-medium whitespace-nowrap">
                            <th class="px-6 py-4">
                                <?= $index++ ?>
                            </th>
                            <th class="px-6 py-4">
                                <?= $type['name'] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $type['code'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $type['description'] ?>
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="#" class="font-medium text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </a>
                                <a href="#" class="font-medium text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </a>
                                <a href="#" class="font-medium text-yellow-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>
</div>