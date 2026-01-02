<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Data Master Kelas
        </h1>

        <a type="button" href="<?= url('create-classes') ?>"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
            + Tambah Kelas
        </a>
    </div>

    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Nama Kelas</th>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Created At</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
<?php if (empty($classes)): ?>
    <tr>
        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
            Belum ada data kelas
        </td>
    </tr>
<?php else: ?>
    <?php foreach ($classes as $class): ?>
        <tr class="bg-white border-b hover:bg-gray-50">
            <td class="px-6 py-4 font-medium text-gray-900">
                <?= htmlspecialchars($class['name']) ?>
            </td>
            <td class="px-6 py-4">
                <?= htmlspecialchars($class['code']) ?>
            </td>
            <td class="px-6 py-4">
                <?= date('Y-m-d', strtotime($class['created_at'])) ?>
            </td>
            <td class="px-6 py-4 text-center space-x-2">
                <a href="<?= url('classes/edit' ,['id' =>$class['id']]) ?>"
                   class="px-3 py-1 text-xs font-medium text-white bg-yellow-400 rounded hover:bg-yellow-500">
                    Edit
                </a>
                <a href="<?= url('edit-classes' . $class['id']) ?>"
                   onclick="return confirm('Yakin hapus data ini?')"
                   class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700">
                    Hapus
                </a>
            </td>
        </tr>
    <?php endforeach ?>
<?php endif ?>
</tbody>

        </table>
    </div>
</div>
</div>