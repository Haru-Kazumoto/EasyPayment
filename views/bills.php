<div class="flex flex-col gap-3">
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Tagihan</h1>
        <p class="text-gray-600">Kelola dan bayar tagihan sekolah Anda</p>
    </div>

    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-blue-100 border border-blue-300 rounded-lg">
                <p class="text-sm text-blue-600 mb-1">Total Tagihan</p>
                <p class="text-2xl font-bold text-blue-700">8</p>
            </div>
            <div class="text-center p-4 bg-green-100 border border-green-300 rounded-lg">
                <p class="text-sm text-green-600 mb-1">Lunas</p>
                <p class="text-2xl font-bold text-green-700">5</p>
            </div>
            <div class="text-center p-4 bg-yellow-100 border border-yellow-300 rounded-lg">
                <p class="text-sm text-yellow-600 mb-1">Pending</p>
                <p class="text-2xl font-bold text-yellow-700">3</p>
            </div>
            <div class="text-center p-4 bg-red-100 border border-red-300 rounded-lg">
                <p class="text-sm text-red-600 mb-1">Jatuh Tempo</p>
                <p class="text-2xl font-bold text-red-700">1</p>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 mb-6">

        <!-- Tagihan List -->
        <div class="divide-y divide-gray-100 p-3">
            <?php foreach ($data_bills as $index => $bill): ?>
                <div class="p-3 hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h3 class="font-semibold text-gray-800"><?= $bill['title'] ?></h3>
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Belum Bayar
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mb-2"><?= $bill['subtitle'] ?></p>
                                <div class="flex flex-wrap gap-3 text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Jatuh tempo: <?= $bill['due_date'] ?>
                                    </div>
                                    <div class="flex items-center text-red-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        5 hari lagi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:items-end gap-3">
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-800"><?= $bill['amount'] ?></p>
                            </div>
                            <a href="/?page=student-bills&action=pay&id=1" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Bayar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>