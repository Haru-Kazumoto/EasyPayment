<div class="flex flex-col gap-3">
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-2">
            <span class="text-2xl font-semibold">Tambah Tagihan Baru</span>

            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="<?= url('dashboard-admin') ?>" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-blue-600">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="<?= url('admin-bills') ?>" class="ms-1 text-sm font-medium text-gray-400 hover:text-blue-600 md:ms-2">
                                Daftar Tagihan
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ms-1 text-sm font-medium text-blue-600 md:ms-2">Tambah Tagihan</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <form id="editBillForm" class="flex flex-col gap-4">
        <input type="hidden" name="id" id="id" value="<?= $bill['id'] ?>">

        <div class="grid grid-cols-5 gap-4">
            <!-- Informasi Dasar -->
            <div class="col-span-3 p-6 rounded-lg border border-gray-200 bg-white shadow">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar Tagihan</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Tagihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="<?= $bill['title'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contoh: SPP Bulan Januari 2024" required>
                    </div>

                    <div class="md:col-span-2">
                        <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-900">
                            Keterangan Tagihan
                        </label>
                        <textarea id="subtitle" name="subtitle" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tambahkan keterangan atau deskripsi tagihan (opsional)"><?= $bill['subtitle'] ?></textarea>
                    </div>

                    <div>
                        <label for="type_id" class="block mb-2 text-sm font-medium text-gray-900">
                            Jenis Tagihan <span class="text-red-500">*</span>
                        </label>
                        <select id="type_id" name="type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="" selected disabled>Pilih jenis tagihan</option>
                            <?php foreach ($types as $index => $type): ?>
                                <option value="<?= $type['id'] ?>" <?= ($type['id'] == $bill['type_id']) ? 'selected' : '' ?>>
                                    <?= $type['name'] ?> (<?= $type['code'] ?>)
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div>
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900">
                            Nominal Tagihan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <span class="text-gray-500 text-sm">Rp</span>
                            </div>
                            <input type="number" id="amount" name="amount" value="<?= $bill['amount'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-2.5" placeholder="0" min="0" required>
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-900 my-4">Periode & Jatuh Tempo</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="academic_year" class="block mb-2 text-sm font-medium text-gray-900">
                            Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <select id="academic_year" name="academic_year"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                            <option value="" disabled>Pilih tahun ajaran</option>

                            <option value="2026/2025"
                                <?= ($bill['academic_year'] === '2026/2025') ? 'selected' : '' ?>>
                                2026/2025
                            </option>

                            <option value="2026/2027"
                                <?= ($bill['academic_year'] === '2026/2027') ? 'selected' : '' ?>>
                                2026/2027
                            </option>

                            <option value="2027/2028"
                                <?= ($bill['academic_year'] === '2027/2028') ? 'selected' : '' ?>>
                                2027/2028
                            </option>
                        </select>

                    </div>

                    <div>
                        <label for="due_date" class="block mb-2 text-sm font-medium text-gray-900">
                            Tanggal Jatuh Tempo <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="due_date" name="due_date" value="<?= $bill['due_date'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>
                </div>
            </div>

            <!-- Summary Tagihan -->
            <div class="col-span-2 p-6 rounded-lg border border-gray-200 bg-white shadow sticky top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Tagihan</h3>

                <div class="space-y-4">
                    <!-- Nama Tagihan -->
                    <div>
                        <p class="text-xs text-gray-500">Nama Tagihan</p>
                        <p id="summary-title" class="font-medium text-gray-900">-</p>
                    </div>

                    <!-- Jenis Tagihan -->
                    <div>
                        <p class="text-xs text-gray-500">Jenis Tagihan</p>
                        <p id="summary-type" class="font-medium text-gray-900">-</p>
                    </div>

                    <!-- Nominal -->
                    <div>
                        <p class="text-xs text-gray-500">Nominal</p>
                        <p id="summary-amount" class="text-lg font-semibold text-blue-600">
                            Rp 0
                        </p>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Tahun Ajaran -->
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Tahun Ajaran</span>
                        <span id="summary-academic-year" class="font-medium text-gray-900">-</span>
                    </div>

                    <!-- Jatuh Tempo -->
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Jatuh Tempo</span>
                        <span id="summary-due-date" class="font-medium text-gray-900">-</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end gap-3 p-6 rounded-lg border border-gray-200 bg-white shadow">
            <a href="<?= url('admin-bills') ?>" class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center border border-gray-300">
                Batal
            </a>
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Simpan Tagihan
            </button>
        </div>
    </form>
</div>
<script>
    const BASE_URL = '<?= url('bills/update') ?>';

    const title = document.getElementById('title');
    const type = document.getElementById('type_id');
    const amount = document.getElementById('amount');
    const academicYear = document.getElementById('academic_year');
    const dueDate = document.getElementById('due_date');

    const summaryTitle = document.getElementById('summary-title');
    const summaryType = document.getElementById('summary-type');
    const summaryAmount = document.getElementById('summary-amount');
    const summaryAcademicYear = document.getElementById('summary-academic-year');
    const summaryDueDate = document.getElementById('summary-due-date');

    const formatRupiah = (value) =>
        'Rp ' + (value || 0).toLocaleString('id-ID');

    function renderSummary() {
        summaryTitle.textContent = title.value || '-';

        summaryType.textContent =
            type.options[type.selectedIndex]?.text || '-';

        summaryAmount.textContent =
            formatRupiah(parseInt(amount.value));

        summaryAcademicYear.textContent =
            academicYear.value || '-';

        summaryDueDate.textContent =
            dueDate.value || '-';
    }

    title.addEventListener('input', renderSummary);
    type.addEventListener('change', renderSummary);
    amount.addEventListener('input', renderSummary);
    academicYear.addEventListener('change', renderSummary);
    dueDate.addEventListener('change', renderSummary);

    document.addEventListener('DOMContentLoaded', renderSummary);
</script>

<!--- AJAX SCRIPT --->
<script>
    const UPDATE_URL = '<?= url("bills/update") ?>';

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('editBillForm');

        if (!form) {
            console.error('Form editBillForm tidak ditemukan');
            return;
        }

        form.addEventListener('submit', handleSubmit);
    });

    function getBillIdFromUrl() {
        const params = new URLSearchParams(window.location.search);
        return params.get('bill_id');
    }

    async function handleSubmit(e) {
        e.preventDefault();

        const billId = document.getElementById('id').value;

        if (!billId) {
            alert('Bill ID tidak ditemukan');
            return;
        }

        const formData = new FormData(e.target);

        try {
            const response = await fetch(`${UPDATE_URL}&bill_id=${billId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                window.location.href = '<?= url('admin-bills') ?>'
            } else {
                alert(result.message || 'Gagal mengupdate data');
            }

        } catch (error) {
            console.error('Error : ', error);
            alert('Terjadi kesalahan saat menyimpan data');
        }
    }
</script>