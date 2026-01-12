<!-- Welcome Section -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl shadow-lg p-6 sm:p-8 mb-6 bg-blue-600 text-white">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl sm:text-3xl font-bold mb-2">
                Selamat Datang, <?= $_SESSION['user']['fullname'] ?? 'Siswa' ?>!
            </h1>
            <p class="text-blue-100">
                Kelola pembayaran sekolah Anda dengan mudah
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 ">
    <div class="flex gap-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-sm text-gray-600 mb-1">Tagihan Terbuat</p>
            <p class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['total_tagihan'], 0, ',', '.') ?></p>
        </div>
    </div>

    <div class="flex gap-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-sm text-gray-600 mb-1">Terbayar</p>
            <p class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['dibayar'], 0, ',', '.') ?></p>
        </div>
    </div>

    <div class="flex gap-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-sm text-gray-600 mb-1">Pending</p>
            <p class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['pending'], 0, ',', '.') ?></p>
            <p class="text-xs text-yellow-600 mt-1"><?= $summary['total_pending'] ?> tagihan pending</p>
        </div>
    </div>

    <div class="flex gap-3 bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="flex flex-col">
            <p class="text-sm text-gray-600 mb-1">Transaksi Bulan Ini</p>
            <p class="text-2xl font-bold text-gray-800">Rp<?= number_format($summary['transaksi_bulan_ini'], 0, ',', '.') ?></p>
            <p class="text-xs text-purple-600 mt-1"><?= $summary['total_berhasil'] ?> transaksi berhasil</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md border border-gray-200">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Tagihan Terbaru</h2>
                <a href="<?= url('bills') ?>" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Lihat Semua
                </a>
            </div>
        </div>
        <div class="p-6 space-y-4">
            <?php foreach ($latest_bills as $bill): ?>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg transition-colors duration-200 border border-gray-200 hover:bg-blue-50 hover:border-blue-200 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800"><?= $bill['title'] ?></h3>
                            <p class="text-sm text-gray-500">Jatuh tempo: <?= format_date($bill['due_date'], false) ?></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">Rp<?= number_format($bill['amount'], 0, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-md border border-gray-200">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">Aksi Cepat</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="<?= url('bills') ?>" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition-all duration-200 group">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Bayar Tagihan</p>
                    </div>
                </a>

                <a href="<?= url('transactions') ?>" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-purple-50 hover:border-purple-200 transition-all duration-200 group">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200">
                        <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Lihat Riwayat</p>
                        <p class="text-xs text-gray-500">Pembayaran Anda</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>