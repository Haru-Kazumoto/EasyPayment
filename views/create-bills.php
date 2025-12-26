<div class="mb-6">
    <a href="/?page=student-bills" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Tagihan
    </a>
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Pembayaran Tagihan</h1>
    <p class="text-gray-600">Lengkapi form pembayaran di bawah ini</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Pembayaran -->
    <div class="lg:col-span-2">
        <form action="/?page=student-bills&action=process" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <!-- Detail Tagihan -->
            <div class="mb-6 pb-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Detail Tagihan</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-gray-600">Nama Tagihan</span>
                        <span class="font-semibold text-gray-800">SPP Desember 2024</span>
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-gray-600">Jatuh Tempo</span>
                        <span class="font-semibold text-gray-800">10 Desember 2024</span>
                    </div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-gray-600">Jumlah Tagihan</span>
                        <span class="font-semibold text-gray-800">Rp 500.000</span>
                    </div>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                        <span class="text-gray-800 font-medium">Total Pembayaran</span>
                        <span class="text-2xl font-bold text-blue-600">Rp 500.000</span>
                    </div>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Metode Pembayaran</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition-colors duration-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                        <input type="radio" name="payment_method" value="transfer" class="w-4 h-4 text-blue-600" checked>
                        <div class="ml-3 flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-800">Transfer Bank</span>
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Transfer ke rekening sekolah</p>
                        </div>
                    </label>

                    <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-blue-500 transition-colors duration-200 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50">
                        <input type="radio" name="payment_method" value="cash" class="w-4 h-4 text-blue-600">
                        <div class="ml-3 flex-1">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-800">Tunai (Cash)</span>
                                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Bayar langsung di sekolah</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Upload Bukti Transfer -->
            <div id="transfer-section" class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Bukti Transfer</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Bukti Transfer <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label for="payment-proof" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG or PDF (MAX. 5MB)</p>
                                </div>
                                <input id="payment-proof" name="payment_proof" type="file" class="hidden" accept="image/*,.pdf" required />
                            </label>
                        </div>
                    </div>

                    <!-- Info Rekening -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h3 class="font-semibold text-blue-800 mb-2">Informasi Rekening Sekolah</h3>
                        <div class="space-y-1 text-sm text-blue-700">
                            <p><strong>Bank:</strong> BCA</p>
                            <p><strong>No. Rekening:</strong> 1234567890</p>
                            <p><strong>Atas Nama:</strong> SMK Negeri 1 Jakarta</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan (Opsional)
                        </label>
                        <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3">
                <a href="/?page=student-bills" class="flex-1 px-6 py-3 text-center font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" class="flex-1 px-6 py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Konfirmasi Pembayaran
                </button>
            </div>
        </form>
    </div>

    <!-- Summary Sidebar -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan</h3>
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Jumlah Tagihan</span>
                    <span class="font-medium">Rp 500.000</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Biaya Admin</span>
                    <span class="font-medium">Rp 0</span>
                </div>
                <div class="pt-3 border-t border-gray-200">
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-800">Total Bayar</span>
                        <span class="text-xl font-bold text-blue-600">Rp 500.000</span>
                    </div>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h4 class="font-semibold text-yellow-800 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Penting!
                </h4>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Pastikan jumlah transfer sesuai</li>
                    <li>• Upload bukti transfer yang jelas</li>
                    <li>• Pembayaran akan diverifikasi 1x24 jam</li>
                </ul>
            </div>
        </div>
    </div>
</div>