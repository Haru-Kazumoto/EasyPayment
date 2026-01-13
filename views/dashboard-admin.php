<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Siswa</p>
                <h3 class="text-2xl font-bold text-gray-800"><?= number_format($summary['total_siswa'], 0) ?></h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-600 flex items-center">
            Siswa tercatat aktif
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Tagihan</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['total_tagihan'], 0, ',', '.') ?></h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 18 20">
                    <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-gray-600">
            <?= $summary['total_data_tagihan'] ?> tagihan aktif
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">Pemasukan</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['total_pemasukan'], 0, ',', '.') ?></h3>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M11.074 4 8.442.408A.95.95 0 0 0 7.014.254L2.926 4h8.148ZM9 13v-1a4 4 0 0 1 4-4h6V6a1 1 0 0 0-1-1H1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1v-2h-6a4 4 0 0 1-4-4Z" />
                    <path d="M19 10h-6a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1Zm-4.5 3.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM12.62 4h2.78L12.539.41a1.086 1.086 0 1 0-1.7 1.352L12.62 4Z" />
                </svg>
            </div>
        </div>
        <p class="text-xs text-green-600 flex items-center">
            <?= $summary['total_data_pemasukan'] ?> transaksi telah diapprove
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 bg-blue-600 rounded-t-xl">
            <h2 class="text-lg font-semibold text-white flex items-center">
                Transaksi Terbaru
            </h2>
        </div>
        <div class="p-6">
            <div class="relative overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-white uppercase bg-blue-600">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold text-white">
                                <div class="flex items-center">
                                    Siswa
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold text-white">
                                <div class="flex items-center">
                                    Tagihan
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold text-white">
                                <div class="flex items-center">
                                    Jumlah
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold text-white">
                                <div class="flex items-center">
                                    Status
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-semibold text-white">
                                <div class="flex items-center">
                                    Tanggal
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($latest_transactions as $transaction): ?>
                            <tr class="bg-white hover:bg-blue-50/50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900"><?= $transaction['student_name'] ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-700 font-medium"><?= $transaction['bill_title'] ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900">Rp<?= number_format($transaction['amount'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center bg-<?= $transaction['status_color'] ?>-100 text-<?= $transaction['status_color'] ?>-700 border border-<?= $transaction['status_color'] ?>-300 text-xs font-semibold px-3 py-1.5 rounded-full">
                                        <span class="w-1.5 h-1.5 bg-<?= $transaction['status_color'] ?>-500 rounded-full mr-2"></span>
                                        <?= $transaction['status'] === 'pending' ? 'Menunggu' : 'Disetujui' ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm"><?= format_date($transaction['paid_at'], true) ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- Empty State (jika tidak ada data) -->
            <?php if (empty($latest_transactions)): ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm6 6H7v2h6v-2z" clip-rule="evenodd" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Transaksi</h3>
                    <p class="text-gray-500 text-sm">Transaksi terbaru akan muncul di sini</p>
                </div>
            <?php endif ?>

            <div class="mt-6 flex items-center justify-between border-t border-gray-200 pt-4">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900"><?= count($latest_transactions) ?></span> transaksi terbaru
                </p>
                <a href="<?= url('student-transactions') ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-semibold hover:underline transition-all group">
                    Lihat Semua Transaksi
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow h-fit">
        <div class="p-6 border-b border-gray-200 bg-blue-600 rounded-t-lg">
            <h2 class="text-lg font-semibold text-white">Aksi Cepat</h2>
        </div>
        <div class="p-6 space-y-3">
            <a href="<?= url('students') ?>" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Tambah Siswa</p>
                    <p class="text-xs text-gray-500">Daftarkan siswa baru</p>
                </div>
            </a>

            <a href="<?= url('admin-bills') ?>" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Buat Tagihan</p>
                    <p class="text-xs text-gray-500">Tambah tagihan baru</p>
                </div>
            </a>

            <a href="<?= url('student-transactions') ?>" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Verifikasi Pembayaran</p>
                    <p class="text-xs text-gray-500">Validasi pembayaran baru</p>
                </div>
            </a>
        </div>
    </div>
</div>