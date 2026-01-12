<div class="flex flex-col gap-3">
    <div class="flex flex-col gap-2">
        <span class="text-2xl font-semibold">Detail Tagihan</span>

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
                        <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Detail Tagihan</span>
                    </div>
                </li>
            </ol>
        </nav>
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

    <!-- Card Detail Pembayaran -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Header Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <div class="flex items-center sm:justify-between flex-wrap gap-2">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <svg class="w-5 h-5 sm:w-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-blue-600 font-semibold text-md sm:text-lg"><?= htmlspecialchars($data_bill['title']) ?></h2>
                        <p class="text-blue-500 text-sm"><?= htmlspecialchars($data_bill['subtitle']) ?></p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <span class="bg-blue-600 text-white text-xs font-medium px-3 py-1.5 rounded-full w-fit ms-auto">
                        <?= htmlspecialchars($data_bill['type_name']) ?>
                    </span>

                    <span class="bg-<?= $data_bill['color'] ?>-600 text-white text-xs font-medium px-3 py-1.5 rounded-full w-fit ms-auto">
                        <?= htmlspecialchars($data_bill['status']) ?>
                    </span>

                </div>
            </div>
        </div>

        <!-- Body Card -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Jumlah Tagihan -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-500">Jumlah Tagihan</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-baseline gap-1">
                            <span class="text-sm text-gray-600">Rp</span>
                            <span class="text-3xl font-bold text-gray-900">
                                <?= number_format($data_bill['amount'], 0, ',', '.') ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Informasi Jatuh Tempo -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-500">Jatuh Tempo</label>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-xl font-semibold text-gray-900">
                                <?php
                                $date = new DateTime($data_bill['due_date']);
                                echo $date->format('d M Y');
                                ?>
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            <?php
                            $now = new DateTime();
                            $diff = $now->diff($date);
                            if ($date < $now) {
                                echo '<span class="text-red-600 font-medium">Terlambat ' . $diff->days . ' hari</span>';
                            } else {
                                echo '<span class="text-green-600 font-medium">' . $diff->days . ' hari lagi</span>';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <?php if (!$data_bill['student_bill_id']): ?>
                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <button type="button"
                        data-modal-target="confirmation-modal"
                        data-modal-toggle="confirmation-modal"
                        data-id="<?= $data_bill['bill_id'] ?>"
                        data-title="<?= htmlspecialchars($data_bill['title']) ?>"
                        data-amount="<?= number_format($data_bill['amount'], 0, ',', '.') ?>"
                        class="confirm-btn flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Registrasi Pembayaran
                    </button>
                </div>
            <?php endif ?>

            <!-- CONFIRMATION MODAL -->
            <div id="confirmation-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-xl shadow-lg p-4">
                        <!-- Close Button -->
                        <button type="button" class="absolute top-3 end-3 text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition duration-200" data-modal-hide="confirmation-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                        <form action="<?= url('bills/register', ['bill_id' => $data_bill['bill_id']]) ?>" method="POST">
                            <!-- Icon Header -->
                            <div class="flex justify-center mb-4">
                                <div class="bg-blue-100 rounded-full p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                    </svg>

                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="mb-2 text-xl font-semibold text-gray-900 text-center">Registrasi Pembayaran</h3>
                            <p class="mb-6 text-sm text-gray-500 text-center">Pastikan data pembayaran sudah benar sebelum meregistrasi</p>

                            <!-- Payment Details Card -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                                <div class="space-y-3">
                                    <div class="flex justify-between items-start">
                                        <span class="text-sm text-gray-600">Nama Tagihan</span>
                                        <span id="data-item-title" class="text-sm font-semibold text-gray-900 text-right max-w-[60%]">-</span>
                                    </div>
                                    <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-700">Total Pembayaran</span>
                                        <div class="text-right">
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-xs text-gray-600">Rp</span>
                                                <span id="data-item-amount" class="text-lg font-bold text-blue-600">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="data-id" name="bill_id" value="">

                            <!-- Action Buttons -->

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="submit" class="flex-1 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 flex items-center justify-center gap-2">
                                    Registrasi
                                </button>
                                <button data-modal-hide="confirmation-modal" type="button" class="flex-1 py-2.5 px-5 text-sm font-medium text-gray-700 focus:outline-none bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:z-10 focus:ring-4 focus:ring-gray-200 transition duration-200">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Riwayat Transaksi Pembayaran -->
    <?php if ($data_bill['student_bill_id']): ?>
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden mt-6">
            <!-- Header Card -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <div class="flex items-center justify-between flex-wrap gap-3">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-green-600 font-semibold text-md sm:text-lg">Riwayat Pembayaran</h2>
                            <p class="text-green-500 text-sm">Daftar pembayaran untuk tagihan ini</p>
                        </div>
                    </div>

                    <div class="flex gap-3 items-center">
                        <div class="bg-green-400/20 px-3 py-1.5 rounded-full">
                            <span class="text-green-600 text-sm font-medium">
                                <?php
                                // Contoh: hitung total transaksi
                                $total_transactions = count($transactions ?? []);
                                echo $total_transactions . ' Pembayaran';
                                ?>
                            </span>
                        </div>

                        <?php
                        $total_paid = array_sum(array_column($transactions, 'amount'));
                        ?>

                        <?php if (($data_bill['amount'] - $total_paid) > 0): ?>
                            <button data-modal-target="payment-modal" data-modal-toggle="payment-modal" data-id="<?= $data_bill['bill_id'] ?>" type="button" class="focus:outline-none text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                Upload Pembayaran
                            </button>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- Body Card -->
            <div class="p-6">
                <?php if (!empty($transactions)): ?>
                    <!-- Transaction List -->
                    <div class="space-y-3">
                        <?php foreach ($transactions as $index => $transaction): ?>
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <!-- Transaction Info -->
                                    <div class="flex items-start gap-3 flex-1">
                                        <div class="bg-green-100 p-2 rounded-lg flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h3 class="font-semibold text-gray-900 text-sm">
                                                    <?= $transaction['trx_number'] ?>
                                                </h3>
                                                <span class="bg-<?= $transaction['status_color'] ?>-100 text-<?= $transaction['status_color'] ?>-700 text-xs font-medium px-2 py-0.5 rounded-full">
                                                    <?= htmlspecialchars($transaction['status']) ?>
                                                </span>
                                            </div>
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-3 text-sm text-gray-600">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span><?= date('d M Y', strtotime($transaction['paid_at'])) ?></span>
                                                </div>
                                                <?php if (!empty($transaction['payment_method'])): ?>
                                                    <span class="hidden sm:inline text-gray-300">•</span>
                                                    <span><?= htmlspecialchars($transaction['payment_method']) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Amount & Actions -->
                                    <div class="flex items-center justify-between sm:justify-end gap-3 sm:gap-4">
                                        <div class="text-right">
                                            <div class="flex items-baseline gap-1">
                                                <span class="text-xs text-gray-600">Rp</span>
                                                <span class="text-lg font-bold text-gray-900">
                                                    <?= number_format($transaction['amount'], 0, ',', '.') ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Summary -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-700">Total Dibayar</span>
                                <div class="text-right">
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm text-gray-600">Rp</span>
                                        <span class="text-2xl font-bold text-green-600">
                                            <?php
                                            $total_paid = array_sum(array_column($transactions, 'amount'));
                                            echo number_format($total_paid, 0, ',', '.');
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($data_bill['amount'])): ?>
                                <div class="mt-2 pt-2 border-t border-gray-200 flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Sisa Tagihan</span>
                                    <span class="font-semibold <?= ($data_bill['amount'] - $total_paid) > 0 ? 'text-red-600' : 'text-green-600' ?>">
                                        Rp <?= number_format($data_bill['amount'] - $total_paid, 0, ',', '.') ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
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
                        <p class="text-gray-600 text-sm mb-6">Belum ada pembayaran yang terdaftar untuk tagihan ini</p>
                        <button type="button"
                            data-modal-target="payment-modal"
                            data-modal-toggle="payment-modal"
                            data-id="<?= $data_bill['bill_id'] ?>"
                            data-title="<?= htmlspecialchars($data_bill['title']) ?>"
                            data-amount="<?= number_format($data_bill['amount'], 0, ',', '.') ?>"
                            class="confirm-btn inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-6 rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Registrasi Pembayaran Pertama
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Payment Modal -->
            <div id="payment-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50">
                <div class="relative p-4 w-full max-w-lg max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-xl shadow-lg">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-5 border-b border-gray-200 rounded-t">
                            <div class="flex items-center gap-3">
                                <div class="bg-green-100 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        Tambah Pembayaran
                                    </h3>
                                    <p class="text-sm text-gray-500">Registrasi pembayaran baru</p>
                                </div>
                            </div>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition duration-200" data-modal-toggle="payment-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <form class="p-5" id="payment-form">
                            <input type="hidden" name="bill_id" id="payment-bill-id" value="">

                            <!-- Alert Success (Hidden by default) -->
                            <div id="success-alert" class="hidden mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-green-800">Pembayaran berhasil diregistrasi!</span>
                                </div>
                            </div>

                            <!-- Alert Error (Hidden by default) -->
                            <div id="error-alert" class="hidden mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-red-800" id="error-message">Terjadi kesalahan!</span>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- Jumlah Pembayaran -->
                                <div>
                                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                                        Jumlah Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="text-gray-500 text-sm font-medium">Rp</span>
                                        </div>
                                        <input type="number"
                                            name="amount"
                                            id="amount"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-11 p-2.5"
                                            placeholder="0"
                                            required
                                            min="1">
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Masukkan jumlah pembayaran dalam Rupiah</p>
                                </div>

                                <!-- Metode Pembayaran -->
                                <div>
                                    <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900">
                                        Metode Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="relative flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition duration-200 payment-method-option">
                                            <input type="radio" name="payment_method" value="cash" class="sr-only peer" required>
                                            <div class="flex items-center gap-3 w-full">
                                                <div class="bg-gray-100 p-2 rounded-lg peer-checked:bg-green-100">
                                                    <svg class="w-5 h-5 text-gray-600 peer-checked:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <span class="text-sm font-medium text-gray-900">Cash</span>
                                                </div>
                                            </div>
                                            <div class="absolute top-2 right-2 hidden peer-checked:block">
                                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </label>

                                        <label class="relative flex items-center p-3 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition duration-200 payment-method-option">
                                            <input type="radio" name="payment_method" value="transfer" class="sr-only peer" required>
                                            <div class="flex items-center gap-3 w-full">
                                                <div class="bg-gray-100 p-2 rounded-lg peer-checked:bg-green-100">
                                                    <svg class="w-5 h-5 text-gray-600 peer-checked:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <span class="text-sm font-medium text-gray-900">Transfer</span>
                                                </div>
                                            </div>
                                            <div class="absolute top-2 right-2 hidden peer-checked:block">
                                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6 flex gap-3">
                                <button type="submit"
                                    id="submit-btn"
                                    class="flex-1 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 inline-flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <span id="submit-text">Simpan Pembayaran</span>
                                </button>
                                <button type="button"
                                    data-modal-toggle="payment-modal"
                                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 transition duration-200">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

</div>

<script>
    document.querySelectorAll('.confirm-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Set title
            document.getElementById('data-item-title').textContent = this.dataset.title;

            // Set amount
            document.getElementById('data-item-amount').textContent = this.dataset.amount;

            // Set hidden bill_id
            document.getElementById('data-id').value = this.dataset.id;
        });
    });

    // Payment Modal Handler
    document.querySelectorAll('.add-payment-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Set bill_id ke payment form
            document.getElementById('payment-bill-id').value = this.dataset.id;

            // Reset form
            document.getElementById('payment-form').reset();

            // Hide alerts
            document.getElementById('success-alert').classList.add('hidden');
            document.getElementById('error-alert').classList.add('hidden');
        });
    });

    // Payment Method Selection Visual Feedback
    document.querySelectorAll('.payment-method-option').forEach(label => {
        label.addEventListener('click', function() {
            // Remove active class from all
            document.querySelectorAll('.payment-method-option').forEach(l => {
                l.classList.remove('border-green-500', 'bg-green-50');
            });
            // Add active class to selected
            this.classList.add('border-green-500', 'bg-green-50');
        });
    });

    // AJAX Form Submission
    document.getElementById('payment-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        // Disable button and show loading
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

        // Hide alerts
        successAlert.classList.add('hidden');
        errorAlert.classList.add('hidden');

        // Get form data
        const formData = new FormData(this);

        // Send AJAX request
        fetch('<?= url("transaction/upload", ['bill_id' => $data_bill['bill_id']]) ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success alert
                    successAlert.classList.remove('hidden');

                    // Reset form
                    document.getElementById('payment-form').reset();

                    // Remove active state from payment methods
                    document.querySelectorAll('.payment-method-option').forEach(l => {
                        l.classList.remove('border-green-500', 'bg-green-50');
                    });

                    // Reload page after 1.5 seconds
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    // Show error alert
                    document.getElementById('error-message').textContent = data.message || 'Terjadi kesalahan!';
                    errorAlert.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('error-message').textContent = 'Terjadi kesalahan koneksi!';
                errorAlert.classList.remove('hidden');
            })
            .finally(() => {
                // Re-enable button
                submitBtn.disabled = false;
                submitText.textContent = 'Simpan Pembayaran';
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            });
    });

    // Format number input (add thousand separator on blur)
    document.getElementById('amount').addEventListener('blur', function() {
        if (this.value) {
            const value = parseInt(this.value.replace(/\./g, ''));
            if (!isNaN(value)) {
                this.value = value;
            }
        }
    });
</script>