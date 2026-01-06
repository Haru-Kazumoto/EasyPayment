<div class="flex flex-col gap-3">
    <div class="flex flex-col gap-2">

        <span class="text-2xl font-semibold">Detail Siswa</span>

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="<?= url('dashboard-student') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                        Dashboard
                    </a>
                </li>
                <li class="inline-flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="<?= url('students') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600 ">
                        Daftar Siswa
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#" class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Detail Siswa</a>
                    </div>
                </li>
            </ol>
        </nav>

    </div>

    <div class="grid grid-cols-3 gap-4">
        <!-- Informasi Siswa - Tinggi sesuai konten -->
        <div class="col-span-1 py-4 px-5 border-2 border-gray-300 rounded-md self-start">
            <span class="text-lg font-semibold mb-3 block">Informasi Siswa</span>

            <div class="flex flex-col gap-1">
                <div class="flex">
                    <span class="w-32 text-gray-600">Nama Lengkap</span>
                    <span class="font-medium">: <?= $student['fullname'] ?></span>
                </div>

                <div class="flex">
                    <span class="w-32 text-gray-600">NISN</span>
                    <span class="font-medium">: <?= $student['nisn'] ?></span>
                </div>

                <div class="flex">
                    <span class="w-32 text-gray-600">Tanggal Masuk</span>
                    <span class="font-medium">: <?= format_date($student['join_date'], false) ?></span>
                </div>

                <div class="flex">
                    <span class="w-32 text-gray-600">Kelas</span>
                    <span class="font-medium">: <?= $student['class_name'] ?></span>
                </div>
            </div>
        </div>

        <!-- Informasi Pembayaran - Tinggi mengikuti data -->
        <div class="col-span-2 py-4 px-5 border-2 border-gray-300 rounded-md">
            <span class="text-lg font-semibold mb-3 block">Informasi Pembayaran</span>

            <?php if (!empty($student_payments)): ?>
                <div class="flex flex-col gap-4">
                    <?php foreach ($student_payments as $payment): ?>
                        <div class="p-4 bg-gray-50 rounded-md border border-gray-200">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Tagihan</span>
                                    <span class="font-semibold text-base"><?= $payment['bill_name'] ?></span>
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Jumlah</span>
                                    <span class="font-semibold text-lg text-blue-600">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></span>
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Metode Pembayaran</span>
                                    <span class="font-medium"><?= $payment['payment_method'] ?></span>
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Tanggal Bayar</span>
                                    <span class="font-medium"><?= format_date($payment['paid_at']) ?></span>
                                </div>

                                <div class="flex flex-col col-span-2">
                                    <span class="text-gray-600 text-sm">No. Transaksi</span>
                                    <span class="text-xs text-gray-500 font-mono"><?= $payment['trx_number'] ?></span>
                                </div>

                                <div class="flex flex-col">
                                    <span class="text-gray-600 text-sm">Status Persetujuan</span>
                                    <span class="font-medium">
                                        <?php if ($payment['approved_at']): ?>
                                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-700">
                                                ✓ Disetujui
                                            </span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-700">
                                                ⏳ Menunggu
                                            </span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <p>Belum ada data pembayaran</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>