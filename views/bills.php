<div class="flex flex-col gap-6">
    <!-- Header -->
    <div class="flex flex-col">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Tagihan</h1>
        <p class="text-gray-600 mt-1">Kelola dan bayar tagihan sekolah Anda</p>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-md p-4 md:p-5">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <!-- Search Input -->
            <div class="md:col-span-8 lg:col-span-9">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search"
                        id="search-bill"
                        class="w-full pl-10 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        placeholder="Cari nama tagihan atau siswa..."
                        onkeyup="filterBills()">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center hidden" id="search-clear">
                        <button type="button" onclick="clearSearch()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Type Filter -->
            <div class="md:col-span-4 lg:col-span-3">
                <div class="relative">
                    <select id="type-filter"
                        class="w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        onchange="filterBills()">
                        <option value="all">Semua Tipe</option>
                        <option value="tuition">Uang SPP</option>
                        <option value="book">Buku & Modul</option>
                        <option value="uniform">Seragam</option>
                        <option value="activity">Kegiatan</option>
                        <option value="other">Lainnya</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Status (Tabs) -->
        <div class="mt-4 flex flex-wrap gap-2" id="status-filters">
            <button type="button" class="filter-tab active px-4 py-2 text-sm font-medium rounded-lg bg-blue-600 text-white" onclick="filterByStatus('all')">
                Semua
            </button>
            <button type="button" class="filter-tab px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200" onclick="filterByStatus('overdue')">
                Terlambat
            </button>
        </div>
    </div>

    <!-- Bills Count -->
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-600" id="bill-count">
            Menampilkan <span class="font-semibold"><?= count($data_bills) ?></span> tagihan
        </p>
        <button type="button" onclick="resetFilters()" class="text-sm text-blue-600 hover:text-blue-800 font-medium hidden" id="reset-filters">
            Reset Filter
        </button>
    </div>

    <!-- Tagihan List -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden" id="bills-container">
        <?php if (!empty($data_bills)): ?>
            <?php foreach ($data_bills as $index => $bill):
                // Determine status class
                $status_class = '';
                $badge_class = '';
                $is_overdue = strtotime($bill['due_date']) < time() && $bill['status'] !== 'Lunas';

                if ($bill['status'] === 'Lunas') {
                    $status_class = 'paid';
                    $badge_class = 'bg-green-100 text-green-800 border-green-200';
                } elseif ($is_overdue) {
                    $status_class = 'overdue';
                    $badge_class = 'bg-red-100 text-red-800 border-red-200';
                } else {
                    $status_class = 'pending';
                    $badge_class = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                }
            ?>
                <div class="bill-item border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors duration-150 <?= $status_class ?>"
                    data-title="<?= htmlspecialchars(strtolower($bill['title'])) ?>"
                    data-subtitle="<?= htmlspecialchars(strtolower($bill['subtitle'])) ?>"
                    data-status="<?= $status_class ?>"
                    data-type="<?= $bill['type'] ?? 'other' ?>">

                    <div class="p-4 md:p-5">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <!-- Left Section: Bill Info -->
                            <div class="flex items-start gap-4">
                                <!-- Icon -->
                                <div class="relative flex-shrink-0">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center 
                                        <?= $status_class === 'paid' ? 'bg-green-50 border border-green-100' : ($status_class === 'overdue' ? 'bg-red-50 border border-red-100' :
                                                'bg-blue-50 border border-blue-100') ?>">
                                        <svg class="w-6 h-6 
                                            <?= $status_class === 'paid' ? 'text-green-600' : ($status_class === 'overdue' ? 'text-red-600' :
                                                    'text-blue-600') ?>"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Bill Details -->
                                <div class="flex-1 min-w-0">
                                    <!-- Title and Status -->
                                    <div class="flex items-start justify-between gap-3 mb-2">
                                        <div class="min-w-0">
                                            <h3 class="font-semibold text-gray-900 text-base leading-tight truncate">
                                                <?= htmlspecialchars($bill['title']) ?>
                                            </h3>
                                            <?php if (!empty($bill['subtitle'])): ?>
                                                <p class="text-sm text-gray-600 mt-1 truncate"><?= htmlspecialchars($bill['subtitle']) ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?= $badge_class ?> flex-shrink-0">
                                            <?php if ($is_overdue): ?>
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            <?php endif; ?>
                                            <?= htmlspecialchars($bill['status']) ?>
                                        </span>
                                    </div>

                                    <!-- Metadata -->
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-600">
                                        <!-- Due Date -->
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="<?= $is_overdue ? 'text-red-600 font-medium' : '' ?>">
                                                Jatuh tempo: <?= format_date($bill['due_date'], false) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section: Amount & Action -->
                            <div class="flex flex-col sm:items-end gap-3 min-w-[160px]">
                                <!-- Amount -->
                                <div class="text-right">
                                    <p class="text-2xl font-bold text-gray-900 leading-tight">
                                        Rp <?= number_format($bill['bill_amount'], 0, ',', '.') ?>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">Total Tagihan</p>
                                </div>

                                <!-- Action Button -->
                                <?php if (empty($bill['student_bill_id']) || $bill['status'] !== 'Lunas'): ?>
                                    <a href="<?= url('bills/show', ['bill_id' => $bill['bill_id']]) ?>"
                                        class="w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200 text-center inline-flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        <?= $bill['status'] === 'Lunas' ? 'Detail Pembayaran' : 'Bayar Tagihan' ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= url('bills/show', ['bill_id' => $bill['bill_id']]) ?>"
                                        class="w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-blue-600 hover:text-blue-800 border border-blue-200 hover:border-blue-300 hover:bg-blue-50 rounded-lg transition-colors duration-200 text-center inline-flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Detail
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Tagihan</h3>
                <p class="text-gray-600 text-sm mb-4">Tidak ditemukan tagihan yang sesuai</p>
                <button type="button" onclick="resetFilters()" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                    Reset filter untuk melihat semua tagihan
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- JavaScript untuk Filter -->
<script>
    // Variabel global untuk menyimpan data tagihan asli
    let allBills = document.querySelectorAll('.bill-item');
    let currentStatus = 'all';
    let currentType = 'all';
    let currentSearch = '';

    // Fungsi untuk filter tagihan
    function filterBills() {
        const searchTerm = document.getElementById('search-bill').value.toLowerCase();
        const typeFilter = document.getElementById('type-filter').value;

        currentSearch = searchTerm;
        currentType = typeFilter;

        let visibleCount = 0;

        allBills.forEach(bill => {
            const title = bill.dataset.title || '';
            const subtitle = bill.dataset.subtitle || '';
            const status = bill.dataset.status || '';
            const type = bill.dataset.type || 'other';

            // Cek pencarian
            const searchMatch = searchTerm === '' ||
                title.includes(searchTerm) ||
                subtitle.includes(searchTerm);

            // Cek filter tipe
            const typeMatch = typeFilter === 'all' || type === typeFilter;

            // Cek filter status
            const statusMatch = currentStatus === 'all' || status === currentStatus;

            // Tampilkan/sembunyikan berdasarkan semua filter
            if (searchMatch && typeMatch && statusMatch) {
                bill.style.display = '';
                visibleCount++;
            } else {
                bill.style.display = 'none';
            }
        });

        // Update counter
        updateBillCount(visibleCount);

        // Tampilkan/sembunyikan tombol clear search
        const searchClear = document.getElementById('search-clear');
        if (searchTerm.length > 0) {
            searchClear.classList.remove('hidden');
        } else {
            searchClear.classList.add('hidden');
        }

        // Tampilkan/sembunyikan tombol reset filter
        const resetBtn = document.getElementById('reset-filters');
        if (searchTerm.length > 0 || typeFilter !== 'all' || currentStatus !== 'all') {
            resetBtn.classList.remove('hidden');
        } else {
            resetBtn.classList.add('hidden');
        }

        // Tampilkan pesan jika tidak ada hasil
        showEmptyState(visibleCount === 0);
    }

    // Fungsi untuk filter berdasarkan status
    function filterByStatus(status) {
        // Update active tab
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active', 'bg-blue-600', 'text-white');
            tab.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        });

        const activeTab = event.target;
        activeTab.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        activeTab.classList.add('active', 'bg-blue-600', 'text-white');

        currentStatus = status;
        filterBills();
    }

    // Fungsi untuk reset semua filter
    function resetFilters() {
        // Reset search
        document.getElementById('search-bill').value = '';
        document.getElementById('search-clear').classList.add('hidden');

        // Reset type filter
        document.getElementById('type-filter').value = 'all';

        // Reset status filter
        currentStatus = 'all';
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active', 'bg-blue-600', 'text-white');
            tab.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        });
        document.querySelector('.filter-tab').classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        document.querySelector('.filter-tab').classList.add('active', 'bg-blue-600', 'text-white');

        // Reset bill count
        document.getElementById('reset-filters').classList.add('hidden');

        // Tampilkan semua bill
        allBills.forEach(bill => {
            bill.style.display = '';
        });

        updateBillCount(allBills.length);
        showEmptyState(allBills.length === 0);
    }

    // Fungsi untuk clear search
    function clearSearch() {
        document.getElementById('search-bill').value = '';
        document.getElementById('search-clear').classList.add('hidden');
        filterBills();
    }

    // Fungsi untuk update counter
    function updateBillCount(count) {
        const countElement = document.getElementById('bill-count');
        if (countElement) {
            countElement.innerHTML = `Menampilkan <span class="font-semibold">${count}</span> tagihan`;
        }
    }

    // Fungsi untuk menampilkan empty state
    function showEmptyState(isEmpty) {
        const container = document.getElementById('bills-container');
        const emptyState = container.querySelector('.text-center');

        if (isEmpty) {
            // Cek jika empty state sudah ada
            if (!emptyState || !emptyState.classList.contains('text-center')) {
                const emptyHTML = `
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Tagihan</h3>
                    <p class="text-gray-600 text-sm mb-4">Tidak ditemukan tagihan yang sesuai dengan filter</p>
                    <button type="button" onclick="resetFilters()" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Reset filter untuk melihat semua tagihan
                    </button>
                </div>
            `;
                container.innerHTML = emptyHTML;
            }
        }
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        allBills = document.querySelectorAll('.bill-item');
        updateBillCount(allBills.length);

        // Debounce untuk search input
        let searchTimeout;
        document.getElementById('search-bill').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(filterBills, 300);
        });
    });
</script>

<style>
    /* Efek transisi untuk filter */
    .filter-tab {
        transition: all 0.2s ease;
    }

    /* Efek untuk bill items */
    .bill-item {
        transition: all 0.2s ease;
    }

    /* Style untuk input focus */
    input:focus,
    select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .bill-item .flex-col.md\:flex-row {
            gap: 16px;
        }

        .bill-item .min-w-\[160px\] {
            min-width: 100%;
        }
    }
</style>