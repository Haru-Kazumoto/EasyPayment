<div class="flex flex-col space-y-4">
    <div class="flex flex-col gap-2">
        <span class="text-2xl font-semibold">Riwayat Pembayaran</span>

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="<?= url('bills') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600">
                        Daftar Tagihan
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Riwayat Pembayaran</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Transaksi -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Transaksi</p>
                    <p class="text-2xl font-bold text-gray-900"><?= count($transactions) ?></p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Dibayar -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Dibayar</p>
                    <p class="text-2xl font-bold text-green-600">
                        <?php
                        $total = array_sum(array_column($transactions, 'amount'));
                        echo 'Rp ' . number_format($total, 0, ',', '.');
                        ?>
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pembayaran Cash -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Cash</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php
                        $cash = array_sum(array_map(function ($t) {
                            return $t['payment_method'] === 'cash' ? $t['amount'] : 0;
                        }, $transactions));
                        echo 'Rp ' . number_format($cash, 0, ',', '.');
                        ?>
                    </p>
                </div>
                <div class="bg-purple-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pembayaran Transfer -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Transfer</p>
                    <p class="text-2xl font-bold text-gray-900">
                        <?php
                        $transfer = array_sum(array_map(function ($t) {
                            return $t['payment_method'] === 'transfer' ? $t['amount'] : 0;
                        }, $transactions));
                        echo 'Rp ' . number_format($transfer, 0, ',', '.');
                        ?>
                    </p>
                </div>
                <div class="bg-orange-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <label for="search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari nomor transaksi atau catatan...">
                </div>
            </div>
            <div class="flex gap-2">
                <select id="filter-method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-[10rem]">
                    <option value="">Semua Metode</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>
                <select id="filter-sort" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 w-[10rem]">
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                    <option value="highest">Nominal Tertinggi</option>
                    <option value="lowest">Nominal Terendah</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Transactions Table/List -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-blue-600 font-semibold text-md sm:text-lg">Daftar Transaksi</h2>
                        <p class="text-blue-500 text-sm">Semua riwayat pembayaran</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <?php if (!empty($transactions)): ?>
                <!-- Desktop Table View -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">No. Transaksi</th>
                                <th scope="col" class="px-6 py-3">Tanggal</th>
                                <th scope="col" class="px-6 py-3">Metode</th>
                                <th scope="col" class="px-6 py-3">Jumlah</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaction-list">
                            <?php foreach ($transactions as $transaction): ?>
                                <tr class="transaction-item bg-white border-b hover:bg-gray-50"
                                    data-method="<?= strtolower($transaction['payment_method']) ?>"
                                    data-amount="<?= $transaction['amount'] ?>"
                                    data-search="<?= strtolower($transaction['trx_number'] . ' ' . ($transaction['notes'] ?? '')) ?>">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-blue-600"><?= htmlspecialchars($transaction['trx_number']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1 text-gray-900">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <?= date('d M Y H:i', strtotime($transaction['paid_at'])) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if ($transaction['payment_method'] === 'cash'): ?>
                                            <span class="bg-purple-100 text-purple-700 text-xs font-medium px-2.5 py-1 rounded-full">Cash</span>
                                        <?php else: ?>
                                            <span class="bg-orange-100 text-orange-700 text-xs font-medium px-2.5 py-1 rounded-full">Transfer</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-gray-900">Rp <?= number_format($transaction['amount'], 0, ',', '.') ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php
                                            $color = $transaction['status'] === 'PENDING' ? 'yellow' : 'green';
                                        ?>
                                        <span class="bg-<?= $color ?>-100 text-<?= $color ?>-700 text-xs font-medium px-2.5 py-1 rounded-full"><?= $transaction['status'] ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button"
                                            onclick="showDetail(<?= htmlspecialchars(json_encode($transaction)) ?>)"
                                            class="text-blue-600 hover:text-blue-700 hover:bg-blue-50 p-2 rounded-lg transition duration-200"
                                            title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card View -->
                <div class="md:hidden space-y-3" id="transaction-list-mobile">
                    <?php foreach ($transactions as $transaction): ?>
                        <div class="transaction-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200"
                            data-method="<?= strtolower($transaction['payment_method']) ?>"
                            data-amount="<?= $transaction['amount'] ?>"
                            data-search="<?= strtolower($transaction['trx_number'] . ' ' . ($transaction['notes'] ?? '')) ?>">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="bg-blue-100 p-2 rounded-lg">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-blue-600 text-sm"><?= htmlspecialchars($transaction['trx_number']) ?></p>
                                        <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($transaction['paid_at'])) ?></p>
                                    </div>
                                </div>
                                <?php if ($transaction['payment_method'] === 'cash'): ?>
                                    <span class="bg-purple-100 text-purple-700 text-xs font-medium px-2.5 py-1 rounded-full">Cash</span>
                                <?php else: ?>
                                    <span class="bg-orange-100 text-orange-700 text-xs font-medium px-2.5 py-1 rounded-full">Transfer</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                                <span class="text-lg font-bold text-gray-900">Rp <?= number_format($transaction['amount'], 0, ',', '.') ?></span>
                                <button type="button"
                                    onclick="showDetail(<?= htmlspecialchars(json_encode($transaction)) ?>)"
                                    class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                    Detail →
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Empty State for Filtered Results -->
                <div id="empty-state" class="hidden text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <p class="text-gray-600">Tidak ada transaksi yang cocok dengan filter</p>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Transaksi</h3>
                    <p class="text-gray-600 text-sm mb-6">Belum ada riwayat pembayaran yang tercatat</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detail-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-xl shadow-lg">
            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi</h3>
                <button type="button" onclick="closeDetail()" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div id="detail-content" class="space-y-4">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Filter and Search functionality
    const searchInput = document.getElementById('search');
    const filterMethod = document.getElementById('filter-method');
    const filterSort = document.getElementById('filter-sort');
    const transactionItems = document.querySelectorAll('.transaction-item');
    const emptyState = document.getElementById('empty-state');

    function filterTransactions() {
        const searchTerm = searchInput.value.toLowerCase();
        const methodFilter = filterMethod.value;
        let visibleCount = 0;

        let items = Array.from(transactionItems);

        // Sort items
        const sortValue = filterSort.value;
        items.sort((a, b) => {
            if (sortValue === 'newest' || sortValue === 'oldest') {
                // Assuming items are already in newest order by default
                return sortValue === 'oldest' ? 1 : -1;
            } else if (sortValue === 'highest') {
                return parseFloat(b.dataset.amount) - parseFloat(a.dataset.amount);
            } else if (sortValue === 'lowest') {
                return parseFloat(a.dataset.amount) - parseFloat(b.dataset.amount);
            }
            return 0;
        });

        // Apply sorting
        items.forEach(item => {
            const parent = item.parentNode;
            parent.appendChild(item);
        });

        // Filter items
        items.forEach(item => {
            const matchesSearch = item.dataset.search.includes(searchTerm);
            const matchesMethod = !methodFilter || item.dataset.method === methodFilter;

            if (matchesSearch && matchesMethod) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0 && transactionItems.length > 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    searchInput?.addEventListener('input', filterTransactions);
    filterMethod?.addEventListener('change', filterTransactions);
    filterSort?.addEventListener('change', filterTransactions);

    // Detail Modal
    function showDetail(transaction) {
        const modal = document.getElementById('detail-modal');
        const content = document.getElementById('detail-content');

        const methodBadge = transaction.payment_method === 'cash' ?
            '<span class="bg-purple-100 text-purple-700 text-xs font-medium px-2.5 py-1 rounded-full">Cash</span>' :
            '<span class="bg-orange-100 text-orange-700 text-xs font-medium px-2.5 py-1 rounded-full">Transfer</span>';

        content.innerHTML = `
        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
            <div class="space-y-3">
                <div class="flex justify-between items-start">
                    <span class="text-sm text-gray-600">Nomor Transaksi</span>
                    <span class="text-sm font-semibold text-gray-900">${transaction.trx_number}</span>
                </div>
                <div class="flex justify-between items-start border-t border-gray-200 pt-3">
                    <span class="text-sm text-gray-600">Tanggal Pembayaran</span>
                    <span class="text-sm font-medium text-gray-900">${new Date(transaction.paid_at).toLocaleString('id-ID', { dateStyle: 'medium', timeStyle: 'short' })}</span>
                </div>
                <div class="flex justify-between items-start border-t border-gray-200 pt-3">
                    <span class="text-sm text-gray-600">Metode Pembayaran</span>
                    ${methodBadge}
                </div>
                <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                    <span class="text-sm font-medium text-gray-700">Jumlah Pembayaran</span>
                    <div class="text-right">
                        <div class="flex items-baseline gap-1">
                            <span class="text-xs text-gray-600">Rp</span>
                            <span class="text-xl font-bold text-green-600">${transaction.amount.toLocaleString('id-ID')}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDetail() {
        const modal = document.getElementById('detail-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close modal on outside click
    document.getElementById('detail-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetail();
        }
    });
</script>