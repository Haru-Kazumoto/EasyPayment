<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Kelas</h2>

    <form action="<?= url('classes/store') ?>" method="POST">
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-700">
                Nama Kelas
            </label>
            <input type="text" name="name" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">
                Kode Kelas
            </label>
            <input type="text" name="code" required
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                          focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
        </div>

        <div class="flex gap-2">
            <button type="submit"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 
                           font-medium rounded-lg text-sm px-5 py-2.5">
                Simpan
            </button>
            <a href="?page=classes"
               class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
               Batal
            </a>
        </div>
    </form>
</div>
