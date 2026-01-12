<div class="flex flex-col gap-3">
    <div class="flex flex-col gap-2">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <span class="text-2xl font-semibold">Approval Pembayaran</span>
            <div class="flex items-center gap-2">
                <span id="pending-count" class="bg-yellow-100 text-yellow-700 text-sm font-medium px-3 py-1.5 rounded-full">
                    <?php
                    $pending = array_filter($transactions, fn($t) => $t['status'] === 'pending');
                    echo count($pending) . ' Menunggu Approval';
                    ?>
                </span>
            </div>
        </div>

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="<?= url('dashboard') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600">
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Approval Pembayaran</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Alert Success (Hidden by default) -->
    <div id="success-alert" class="hidden p-4 mb-4 rounded-lg bg-green-50 border border-green-200">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium text-green-800" id="success-message">Pembayaran berhasil disetujui!</span>
        </div>
    </div>

    <!-- Alert Error (Hidden by default) -->
    <div id="error-alert" class="hidden p-4 mb-4 rounded-lg bg-red-50 border border-red-200">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-sm font-medium text-red-800" id="error-message">Terjadi kesalahan!</span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <div class="flex flex-wrap gap-2">
            <button onclick="filterStatus('all')" class="filter-btn active px-4 py-2 text-sm font-medium rounded-lg transition duration-200 bg-blue-600 text-white" data-status="all">
                Semua
            </button>
            <button onclick="filterStatus('pending')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition duration-200 bg-gray-100 hover:bg-gray-200 text-gray-700" data-status="pending">
                Menunggu Approval
            </button>
            <button onclick="filterStatus('approved')" class="filter-btn px-4 py-2 text-sm font-medium rounded-lg transition duration-200 bg-gray-100 hover:bg-gray-200 text-gray-700" data-status="approved">
                Disetujui
            </button>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-blue-600 font-semibold text-md sm:text-lg">Daftar Pembayaran Siswa</h2>
                    <p class="text-blue-500 text-sm">Kelola approval pembayaran siswa</p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <?php if (!empty($transactions)): ?>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Siswa & Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Tagihan
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody id="transactions-container" class="bg-white divide-y divide-gray-200">
                            <?php foreach ($transactions as $transaction): ?>
                                <tr class="transaction-row hover:bg-gray-50 transition duration-150"
                                    data-status="<?= $transaction['status'] ?>"
                                    data-id="<?= $transaction['id'] ?>">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <?= htmlspecialchars($transaction['student_name']) ?>
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    <?= htmlspecialchars($transaction['trx_number']) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?= htmlspecialchars($transaction['bill_title']) ?></div>
                                        <div class="text-sm text-gray-500">
                                            <?php if ($transaction['payment_method'] === 'cash'): ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    Cash
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                                    </svg>
                                                    Transfer
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y', strtotime($transaction['paid_at'])) ?>
                                        <div class="text-xs text-gray-400">
                                            <?= date('H:i', strtotime($transaction['paid_at'])) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            Rp <?= number_format($transaction['amount'], 0, ',', '.') ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if ($transaction['status'] === 'pending'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                                Menunggu
                                            </span>
                                        <?php elseif ($transaction['status'] === 'approved'): ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                                Disetujui
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                                Ditolak
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <?php if ($transaction['status'] === 'pending'): ?>
                                            <button type="button"
                                                onclick='openApprovalModal(<?= json_encode($transaction) ?>)'
                                                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Review
                                            </button>
                                        <?php else: ?>
                                            <button type="button"
                                                onclick='viewDetail(<?= json_encode($transaction) ?>)'
                                                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Detail
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State for Filtered Results -->
                <div id="empty-filtered" class="hidden text-center py-12 border border-gray-200 rounded-lg">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-gray-600">Tidak ada transaksi dengan status yang dipilih</p>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-12 border border-gray-200 rounded-lg">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Transaksi</h3>
                    <p class="text-gray-600 text-sm">Belum ada pembayaran yang perlu di-review</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approval-modal" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50" aria-hidden="true"></div>

        <!-- Modal positioning trick -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal content -->
        <div class="relative inline-block align-bottom bg-white rounded-xl shadow-lg transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Review Pembayaran</h3>
                        <p class="text-sm text-gray-500">Periksa detail pembayaran sebelum menyetujui</p>
                    </div>
                </div>
                <button type="button" onclick="closeApprovalModal()" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-6">
                <div id="modal-content" class="space-y-4">
                    <!-- Content will be populated by JavaScript -->
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button type="button"
                        id="approve-btn"
                        onclick="approveTransaction()"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="approve-text">Setujui Pembayaran</span>
                    </button>
                    <button type="button"
                        id="reject-btn"
                        onclick="closeApprovalModal()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span id="reject-text">Batal</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div id="detail-modal" tabindex="-1" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50" aria-hidden="true"></div>

        <!-- Modal positioning trick -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal content -->
        <div class="relative inline-block align-bottom bg-white rounded-xl shadow-lg transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Detail Transaksi</h3>
                <button type="button" onclick="closeDetailModal()" class="text-gray-400 hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
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
    let currentTransactionId = null;
    let currentTransactionData = null;

    // Filter functionality
    function filterStatus(status) {
        // Update active filter button
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        });

        const activeBtn = document.querySelector(`[data-status="${status}"]`);
        activeBtn.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
        activeBtn.classList.add('active', 'bg-blue-600', 'text-white');

        // Filter rows
        const rows = document.querySelectorAll('.transaction-row');
        let visibleCount = 0;

        rows.forEach(row => {
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide empty state
        const emptyState = document.getElementById('empty-filtered');
        if (visibleCount === 0 && rows.length > 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    // Modal functions
    function openApprovalModal(transaction) {
        currentTransactionId = transaction.id;
        currentTransactionData = transaction;

        const modal = document.getElementById('approval-modal');
        const content = document.getElementById('modal-content');

        // Populate modal content
        content.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Siswa</h4>
                <p class="text-gray-900 font-semibold">${transaction.student_name}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Nomor Transaksi</h4>
                <p class="text-gray-900 font-semibold">${transaction.trx_number}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Jenis Tagihan</h4>
                <p class="text-gray-900 font-semibold">${transaction.bill_title}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Metode Pembayaran</h4>
                <p class="text-gray-900 font-semibold">
                    ${transaction.payment_method === 'cash' ? 'Cash' : 'Transfer Bank'}
                </p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Tanggal Bayar</h4>
                <p class="text-gray-900 font-semibold">${formatDate(transaction.paid_at)}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-500 mb-1">Jumlah</h4>
                <p class="text-gray-900 font-semibold text-xl">Rp ${formatCurrency(transaction.amount)}</p>
            </div>
        </div>
        ${transaction.notes ? `
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h4 class="text-sm font-medium text-yellow-800 mb-1">Catatan</h4>
            <p class="text-yellow-700">${transaction.notes}</p>
        </div>
        ` : ''}
    `;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeApprovalModal() {
        const modal = document.getElementById('approval-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentTransactionId = null;
        currentTransactionData = null;
    }

    // AJAX Functions
    function approveTransaction() {
        if (!currentTransactionId) return;

        const approveBtn = document.getElementById('approve-btn');
        const approveText = document.getElementById('approve-text');

        // Disable button and show loading
        approveBtn.disabled = true;
        approveBtn.classList.add('opacity-75', 'cursor-not-allowed');
        approveText.innerHTML = 'Menyetujui...';

        const url = `<?= url('transaction/approve') ?>&tx_id=${currentTransactionId}`;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    action: 'approve'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message || 'Pembayaran berhasil disetujui!');
                    updateTransactionStatus(currentTransactionId, 'approved');
                    closeApprovalModal();
                    updatePendingCount();
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan saat menyetujui pembayaran');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan jaringan');
            })
            .finally(() => {
                // Reset button
                approveBtn.disabled = false;
                approveBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                approveText.innerHTML = 'Setujui Pembayaran';
            });
    }

    function rejectTransaction() {
        if (!currentTransactionId) return;

        const rejectBtn = document.getElementById('reject-btn');
        const rejectText = document.getElementById('reject-text');

        // Disable button and show loading
        rejectBtn.disabled = true;
        rejectBtn.classList.add('opacity-75', 'cursor-not-allowed');
        rejectText.innerHTML = 'Menolak...';

        const url = `<?= url('transaction/approve') ?>&tx_id=${currentTransactionId}`;

        fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    action: 'reject'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message || 'Pembayaran berhasil ditolak!');
                    updateTransactionStatus(currentTransactionId, 'rejected');
                    closeApprovalModal();
                    updatePendingCount();
                } else {
                    showAlert('error', data.message || 'Terjadi kesalahan saat menolak pembayaran');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan jaringan');
            })
            .finally(() => {
                // Reset button
                rejectBtn.disabled = false;
                rejectBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                rejectText.innerHTML = 'Tolak Pembayaran';
            });
    }

    // Helper functions
    function updateTransactionStatus(transactionId, status) {
        const row = document.querySelector(`.transaction-row[data-id="${transactionId}"]`);
        if (!row) return;

        // Update status attribute
        row.dataset.status = status;

        // Update status badge
        const statusCell = row.querySelector('td:nth-child(5)');
        let badgeClass, badgeText, dotColor;

        if (status === 'approved') {
            badgeClass = 'bg-green-100 text-green-800';
            badgeText = 'Disetujui';
            dotColor = 'bg-green-500';
        } else if (status === 'rejected') {
            badgeClass = 'bg-red-100 text-red-800';
            badgeText = 'Ditolak';
            dotColor = 'bg-red-500';
        } else {
            badgeClass = 'bg-yellow-100 text-yellow-800';
            badgeText = 'Menunggu';
            dotColor = 'bg-yellow-500';
        }

        statusCell.innerHTML = `
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${badgeClass}">
            <span class="w-2 h-2 ${dotColor} rounded-full mr-2"></span>
            ${badgeText}
        </span>
    `;

        // Update action button
        const actionCell = row.querySelector('td:nth-child(6)');
        if (status === 'pending') {
            actionCell.innerHTML = `
            <button type="button"
                onclick='openApprovalModal(${JSON.stringify(currentTransactionData)})'
                class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Review
            </button>
        `;
        } else {
            actionCell.innerHTML = `
            <button type="button"
                onclick='viewDetail(${JSON.stringify(currentTransactionData)})'
                class="text-gray-600 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Detail
            </button>
        `;
        }
    }

    function updatePendingCount() {
        const pendingRows = document.querySelectorAll('.transaction-row[data-status="pending"]');
        const pendingCount = pendingRows.length;
        const pendingCountElement = document.getElementById('pending-count');

        if (pendingCountElement) {
            pendingCountElement.textContent = `${pendingCount} Menunggu Approval`;
        }
    }

    function showAlert(type, message) {
        const alert = document.getElementById(`${type}-alert`);
        const messageElement = document.getElementById(`${type}-message`);

        if (alert && messageElement) {
            messageElement.textContent = message;
            alert.classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                alert.classList.add('hidden');
            }, 5000);
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function formatCurrency(amount) {
        return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function viewDetail(transaction) {
        const modal = document.getElementById('detail-modal');
        const content = document.getElementById('detail-content');

        content.innerHTML = `
        <div class="space-y-3">
            <div class="flex justify-between">
                <span class="text-gray-500">Nama Siswa:</span>
                <span class="font-semibold">${transaction.student_name}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Nomor Transaksi:</span>
                <span class="font-semibold">${transaction.trx_number}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Jenis Tagihan:</span>
                <span class="font-semibold">${transaction.bill_title}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Metode Pembayaran:</span>
                <span class="font-semibold">${transaction.payment_method === 'cash' ? 'Cash' : 'Transfer Bank'}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tanggal Bayar:</span>
                <span class="font-semibold">${formatDate(transaction.paid_at)}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Jumlah:</span>
                <span class="font-semibold text-lg">Rp ${formatCurrency(transaction.amount)}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Status:</span>
                <span class="font-semibold">
                    ${transaction.status === 'pending' ? 'Menunggu Approval' : 
                      transaction.status === 'approved' ? 'Disetujui' : 'Ditolak'}
                </span>
            </div>
            ${transaction.notes ? `
            <div class="border-t pt-3 mt-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Catatan:</span>
                    <span class="font-semibold text-right max-w-xs">${transaction.notes}</span>
                </div>
            </div>
            ` : ''}
        </div>
    `;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        const modal = document.getElementById('detail-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modals on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeApprovalModal();
            closeDetailModal();
        }
    });

    // Close modals when clicking outside
    document.addEventListener('click', (e) => {
        const approvalModal = document.getElementById('approval-modal');
        const detailModal = document.getElementById('detail-modal');

        if (approvalModal && e.target === approvalModal) {
            closeApprovalModal();
        }

        if (detailModal && e.target === detailModal) {
            closeDetailModal();
        }
    });
</script>