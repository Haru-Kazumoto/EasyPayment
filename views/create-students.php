<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 p-6">

  <!-- Modal Tambah Siswa -->
  <div id="modalTambahSiswa" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto bg-black bg-opacity-50 h-screen">
    <div class="relative w-full max-w-lg bg-white rounded-lg shadow-lg">
      <!-- Header -->
      <div class="flex items-center justify-between p-4 border-b rounded-t">
        <h3 class="text-xl font-semibold text-gray-800">Tambah Siswa Baru</h3>
        <button type="button" class="text-gray-400 hover:text-gray-600" onclick="document.getElementById('modalTambahSiswa').classList.add('hidden')">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Form -->
      <form class="p-6 space-y-5">
        <div>
          <label for="nama" class="block mb-2 text-sm font-medium text-gray-700">Nama Siswa</label>
          <input type="text" id="nama" name="nama" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama lengkap" />
        </div>

        <div>
          <label for="nisn" class="block mb-2 text-sm font-medium text-gray-700">NISN</label>
          <input type="text" id="nisn" name="nisn" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 1234567890" />
        </div>

        <div>
          <label for="telepon" class="block mb-2 text-sm font-medium text-gray-700">Nomor Telepon</label>
          <input type="text" id="telepon" name="telepon" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="08xxxxxxxxxx" />
        </div>

        <div>
          <label for="jurusan" class="block mb-2 text-sm font-medium text-gray-700">Jurusan</label>
          <select id="jurusan" name="jurusan" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih Jurusan</option>
            <option value="TJKT">TJKT</option>
            <option value="RPL">RPL</option>
            <option value="TKJ">TKJ</option>
          </select>
        </div>

        <div>
          <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
          <select id="status" name="status" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="AKTIF">Aktif</option>
            <option value="NONAKTIF">Nonaktif</option>
          </select>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end pt-4">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Submit Data
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- Flowbite Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  <!-- Auto Show Modal on Load -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.getElementById('modalTambahSiswa').classList.remove('hidden');
    });
  </script>
</body>
</html>
